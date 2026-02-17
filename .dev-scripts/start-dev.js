import http from "http"
import { exec } from "child_process"
import fs from "fs"

const config = JSON.parse(
  fs.readFileSync("./dev.config.json", "utf-8")
)

const SITE_URL = config.siteUrl || "http://localhost/wordpress"
const line = "─".repeat(38)

function box(title, lines = []) {
  console.log(`\n┌${line}┐`)
  console.log(`│ ${title.padEnd(36)} │`)
  console.log(`├${line}┤`)

  lines.forEach(l => {
    console.log(`│ ${l.padEnd(36)} │`)
  })

  console.log(`└${line}┘\n`)
}

function checkServer() {
  return new Promise(resolve => {
    http.get("http://localhost", () => resolve(true))
      .on("error", () => resolve(false))
  })
}

async function start() {
  box(" STARTING DEV ENVIRONMENT", [
    "Checking local server..."
  ])

  const serverRunning = await checkServer()

  if (!serverRunning) {
    box("SERVER NOT RUNNING", [
      "Apache/XAMPP not detected",
      "Start XAMPP and try again",
      "",
      "npm run dev"
    ])
    process.exit()
  }

  box("SERVER OK", [
    "Apache/XAMPP running",
    "Starting Tailwind + Vite",
    "",
    SITE_URL
  ])

  exec(
    'concurrently "npx tailwindcss -i ./assets/src/tailwind/input.css -o ./assets/src/tailwind/output.css --watch" "vite"',
    { stdio: "inherit" }
  )
}

start()
