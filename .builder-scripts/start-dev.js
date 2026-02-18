import http from "http";
import { exec } from "child_process";
import chalk from "chalk";
import dotenv from 'dotenv';
dotenv.config();

const SITE_URL = process.env.SITE_URL || "http://localhost/wordpress";

//  Красивый box
function box(title, lines = [], color = "white") {
  // Находим самую длинную строку
  const allLines = [title, ...lines];
  const width = Math.max(...allLines.map(l => l.length)) + 2; // +2 для отступа

  const top = "┌" + "─".repeat(width) + "┐";
  const middle = "├" + "─".repeat(width) + "┤";
  const bottom = "└" + "─".repeat(width) + "┘";

  const colorFn = chalk[color] || chalk.white;

  console.log("\n" + colorFn(top));
  console.log(colorFn(`│ ${title.padEnd(width - 1)}│`));
  console.log(colorFn(middle));

  lines.forEach(l => {
    console.log(colorFn(`│ ${l.padEnd(width - 1)}│`));
  });

  console.log(colorFn(bottom) + "\n");
}

//  Проверка сервера
function checkServer(url = "http://localhost") {
  return new Promise(resolve => {
    http.get(url, () => resolve(true))
      .on("error", () => resolve(false));
  });
}

//  Старт
async function start() {
  box(" STARTING DEV ENVIRONMENT", [
    `Checking server at ${SITE_URL}...`
  ], "cyan");

  const serverRunning = await checkServer(SITE_URL);

  if (!serverRunning) {
    box("SERVER NOT RUNNING", [
      `No server detected at ${SITE_URL}`,
      "Start your local dev server (Apache, Nginx, Docker, etc.) and try again",
      "",
      "npm run dev"
    ], "red");
    process.exit();
  }

  box("SERVER OK", [
    `Server responding at ${SITE_URL}`,
    "Starting Tailwind + Vite...",
    "",
    SITE_URL
  ], "green");

  exec(
    'concurrently "npx tailwindcss -i ./assets/src/tailwind/input.css -o ./assets/src/tailwind/output.css --watch" "vite"',
    { stdio: "inherit" }
  );
}

start();
