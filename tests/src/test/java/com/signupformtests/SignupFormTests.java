package com.signupformtests;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.annotations.AfterSuite;
import org.testng.annotations.BeforeSuite;
import org.testng.annotations.Test;

public class SignupFormTests {

    public WebDriver driver;
    public String baseUrl;
    
    public String validForename;
    public String validSurname;
    public String validEmail;
    public String validPassword;
    public String validConfirmPassword;

    public String invalidForename;
    public String invalidSurname;
    public String invalidEmail;
    public String invalidPassword;
    public String invalidConfirmPassword;

    @BeforeSuite
    public void setUp() {
        
        // Valid details
        validForename = "Joe";
        validSurname = "Blogs";
        validEmail = "joe.blogs@email.com";
        validPassword = "P@5sword";
        validConfirmPassword = validPassword;
        
        // Invalid details
        invalidForename = "J0e;";
        invalidSurname = "3log5";
        invalidEmail = "joe.blogs@email";
        invalidPassword = "pass/";
        invalidConfirmPassword = "/ssap";

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
