import fs from 'fs-extra';
import path from 'path';
import fonter from 'fonter';
import ttf2woff2 from 'ttf2woff2';

const fontsDir = './assets/src/fonts';
const woffDir = path.join(fontsDir, 'WOFF2');
const fontFacesFile = './assets/src/scss/fonts.scss';

const italicRegex = /italic/i;

const fontWeights = {
  thin: 100,
  hairline: 100,
  extralight: 200,
  ultralight: 200,
  light: 300,
  regular: 400,
  medium: 500,
  semibold: 600,
  demibold: 600,
  bold: 700,
  extrabold: 800,
  ultrabold: 800,
  black: 900,
  heavy: 900,
  extrablack: 950,
  ultrablack: 950
};

const fontFaceTemplate = (name, file, weight, style) => `@font-face {
  font-family: ${name};
  font-display: swap;
  src: url("../fonts/WOFF2/${file}.woff2") format("woff2");
  font-weight: ${weight};
  font-style: ${style};
}\n\n`;

//  Конвертация OTF → TTF
async function otfToTtf() {
  await fs.ensureDir(fontsDir);
  const files = await fs.readdir(fontsDir);

  for (const file of files) {
    if (file.endsWith('.otf')) {
      const input = path.join(fontsDir, file);
      const output = path.join(fontsDir, file.replace('.otf', '.ttf'));
      const buffer = fs.readFileSync(input);
      const ttfBuffer = fonter({ formats: ['ttf'], buffer });
      fs.writeFileSync(output, ttfBuffer);
      console.log(` ${file} → TTF`);
    }
  }
}

//  Конвертация TTF → WOFF2
async function ttfToWoff() {
  await fs.ensureDir(woffDir);
  const files = await fs.readdir(fontsDir);

  for (const file of files) {
    if (file.endsWith('.ttf')) {
      const input = path.join(fontsDir, file);
      const output = path.join(woffDir, file.replace('.ttf', '.woff2'));
      const buffer = fs.readFileSync(input);
      const woffBuffer = ttf2woff2(buffer);
      fs.writeFileSync(output, woffBuffer);
      console.log(` ${file} → WOFF2`);
    }
  }
}

//  Генерация SCSS с перезаписью
async function fontStyle() {
  const fontFiles = await fs.readdir(woffDir);
  if (!fontFiles.length) {
    console.log('Нет WOFF2 файлов для генерации SCSS');
    return;
  }

  // Перезаписываем файл
  await fs.writeFile(fontFacesFile, '');
  const processedFonts = new Set();

  const parseFontFileName = (fileName) => {
    let name = fileName;
    let weight = 400;
    let style = 'normal';
    const lower = fileName.toLowerCase();

    if (italicRegex.test(lower)) style = 'italic';

    for (const key in fontWeights) {
      if (lower.includes(key)) { weight = fontWeights[key]; break; }
    }

    if (fileName.includes('-')) {
      name = fileName.split('-')[0];
    } else {
      for (const key in fontWeights) {
        if (lower.includes(key)) { name = fileName.toLowerCase().split(key)[0]; break; }
      }
    }

    name = name.replace(/[_\s]+/g, '');
    return { name, weight, style };
  };

  for (const file of fontFiles) {
    if (!file.endsWith('.woff2')) continue;
    const fileName = file.replace('.woff2', '');
    if (processedFonts.has(fileName)) continue;

    const { name, weight, style } = parseFontFileName(fileName);
    await fs.appendFile(fontFacesFile, fontFaceTemplate(name, fileName, weight, style));
    processedFonts.add(fileName);
  }

  console.log(' fonts.scss перезаписан и обновлён!');
}

//  Основной запуск
async function run() {
  await otfToTtf();
  await ttfToWoff();
  await fontStyle();
}

run();
