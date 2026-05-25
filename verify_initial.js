const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage();
  await page.goto('file://' + process.cwd() + '/index.html');
  await page.screenshot({ path: 'initial_state.png' });

  // Simulate a key press
  await page.keyboard.press('a');
  await page.waitForTimeout(100);
  await page.screenshot({ path: 'after_keypress.png' });

  await browser.close();
})();
