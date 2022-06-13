package com.signupformtests;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.annotations.AfterSuite;
import org.testng.annotations.BeforeSuite;
import org.testng.annotations.Test;

public class SignupFormTests {

    public WebDriver driver;
    public String baseUrl;

    @BeforeSuite
    public void setUp() {

        System.setProperty("webdriver.chrome.driver", "C:\\Users\\macie\\Desktop\\Programming\\WebDrivers\\chromedriver_win32\\chromedriver.exe");
        driver = new ChromeDriver();
        baseUrl = "http://localhost/_registrationForm/register.html";

        driver.manage().window().maximize();
        driver.get(baseUrl);
    }

    @Test
    public void testEmptyForm() {

    }

    @AfterSuite
    public void tearDown() {

        driver.quit();
    }
}
