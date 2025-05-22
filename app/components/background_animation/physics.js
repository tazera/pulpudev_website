/**
 * Background Animation Physics Worker
 * Handles all particle physics calculations in a separate thread
 * to prevent blocking the main UI thread.
 */

let particles = [];
let shootingStars = [];
let width = 0;
let height = 0;
let nextShootAt = 0;

// Configuration constants
const MIN_SPEED = 0.25;
const MAX_SPEED = 2.5;
const SHOOT_INTERVAL_MIN = 8000;
const SHOOT_INTERVAL_MAX = 15000;

/**
 * Helper functions
 */
function randRange(min, max) {
  return Math.random() * (max - min) + min;
}

function spawnShootingStar() {
  const startX = Math.random() < 0.5 ? randRange(0, width) : -50;
  const startY = Math.random() < 0.5 ? -50 : randRange(0, height);
  const angle =
    Math.atan2(height - startY, width - startX) + randRange(-0.2, 0.2);
  shootingStars.push({
    x: startX,
    y: startY,
    dx: Math.cos(angle) * 8,
    dy: Math.sin(angle) * 8,
    life: 1000,
  });
}

/**
 * Message handler for the worker
 */
onmessage = (e) => {
  const { type, data } = e.data;

  // Initialize the physics system
  if (type === "init") {
    ({ particles, width, height } = data);
    nextShootAt =
      performance.now() + randRange(SHOOT_INTERVAL_MIN, SHOOT_INTERVAL_MAX);
  }

  // Step the physics simulation
  if (type === "step") {
    const { dt, time, mouse } = data;

    // Shooting star timing
    if (time > nextShootAt) {
      spawnShootingStar();
      nextShootAt = time + randRange(SHOOT_INTERVAL_MIN, SHOOT_INTERVAL_MAX);
    }

    // Update all particles
    for (const p of particles) {
      // Cursor repulsion (if mouse coordinates were passed)
      if (mouse && mouse.x !== -9999 && mouse.y !== -9999) {
        const dxm = p.x - mouse.x;
        const dym = p.y - mouse.y;
        const distm = Math.hypot(dxm, dym);
        if (distm < 100) {
          const strength = (100 - distm) / 100;
          p.dx += (dxm / distm) * strength * 0.8;
          p.dy += (dym / distm) * strength * 0.8;
        }
      }

      // Position update w/ parallax
      p.x += p.dx * p.depth;
      p.y += p.dy * p.depth;

      // Speed clamp
      let speed = Math.hypot(p.dx, p.dy);
      if (speed > MAX_SPEED) {
        p.dx = (p.dx / speed) * MAX_SPEED;
        p.dy = (p.dy / speed) * MAX_SPEED;
      } else if (speed < MIN_SPEED) {
        p.dx = (p.dx / speed) * MIN_SPEED;
        p.dy = (p.dy / speed) * MIN_SPEED;
      }

      // Bounce
      if (p.x < 0 || p.x > width) p.dx *= -1;
      if (p.y < 0 || p.y > height) p.dy *= -1;
    }

    // Update shooting stars
    for (let i = shootingStars.length - 1; i >= 0; i--) {
      const s = shootingStars[i];
      s.x += s.dx;
      s.y += s.dy;
      s.life -= dt;
      if (s.life <= 0 || s.x > width + 50 || s.y > height + 50) {
        shootingStars.splice(i, 1);
      }
    }

    // Send the updated particles back to the main thread
    postMessage({
      particles,
      shootingStars,
    });
  }

  // Handle canvas resize
  if (type === "resize") {
    width = data.width;
    height = data.height;
  }
};
