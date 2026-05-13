from playwright.sync_api import sync_playwright
import os
import subprocess
import time

def run_cuj(page):
    # Home Page
    page.goto("http://127.0.0.1:3000/index.php")
    page.wait_for_timeout(1000)
    page.screenshot(path="verification/screenshots/home.png", full_page=True)

    # Registration Page
    page.goto("http://127.0.0.1:3000/register.php")
    page.wait_for_timeout(1000)
    page.screenshot(path="verification/screenshots/register.png", full_page=True)

    # Login Page
    page.goto("http://127.0.0.1:3000/login.php")
    page.wait_for_timeout(1000)
    page.screenshot(path="verification/screenshots/login.png")

    # Admin Login Page
    page.goto("http://127.0.0.1:3000/admin/login.php")
    page.wait_for_timeout(1000)
    page.screenshot(path="verification/screenshots/admin_login.png")

    page.wait_for_timeout(1000)

if __name__ == "__main__":
    # Start PHP server
    server = subprocess.Popen(["php", "-S", "127.0.0.1:3000"], stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
    time.sleep(2)

    try:
        with sync_playwright() as p:
            browser = p.chromium.launch(headless=True)
            context = browser.new_context(
                record_video_dir="verification/videos"
            )
            page = context.new_page()
            try:
                run_cuj(page)
            finally:
                context.close()
                browser.close()
    finally:
        server.terminate()
