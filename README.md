## Magento 2 - Login as Customer by Kiwi Commerce

### Overview
- Admin can login as customers to trace any process in which the customer is facing the issue.
- Admin don’t need the password of the customer and the Authentication will not be change.
- Admin can login as customer from the admin panel in just one click and is able to process on the storefront as a customer and is  redirected to My Account’s page.
- This Extension also has security measures to hide login options for different admin users.
- This Extension also has options from where admin can enable and disable the extension.

### **Installation**
 
 1. Composer Installation
      - Navigate to your Magento root folder<br />
            `cd path_to_the_magento_root_directory`<br />
      - Then run the following command<br />
          `composer require kiwicommerce/module-login-as-customer`<br/>
      - Make sure that composer finished the installation without errors.

 2. Command Line Installation
      - Backup your web directory and database.
      - Download Login as Customer installation package from <a href="https://github.com/kiwicommerce/magento2-login-as-customer/releases/download/v1.0.0/kiwicommerce-login-as-customer-v100.zip">here</a>.
      - Upload contents of the Login as Customer installation package to your Magento root directory.
      - Navigate to your Magento root folder<br />
          `cd path_to_the_magento_root_directory`<br />
      - Then run the following command<br />
          `php bin/magento module:enable KiwiCommerce_LoginAsCustomer`<br />
      - Log out from the backend and log in again.
   
- After install the extension, run the following command <br/>
          `php bin/magento setup:upgrade`<br />
          `php bin/magento setup:di:compile`<br />
          `php bin/magento setup:static-content:deploy`<br />
          `php bin/magento cache:flush`
          
Find More details on <a href="https://kiwicommerce.co.uk/extensions/magento2-login-as-customer" target="_blank">Kiwi Commerce</a>

## Where will it appear in Admin Panel

### Customers Grid page

Admin can see the login as customer button on customer Grid page and Edit page.

<img src="https://kiwicommerce.co.uk/wp-content/uploads/2018/05/CustomerGrid-1.png"/><br/>

### Orders Grid Page

Admin can see the login as customer button on Order Grid page and View page.

<img src="https://kiwicommerce.co.uk/wp-content/uploads/2018/05/CustomerOrderGridpng.png"/><br/>


### Login as Customer Log 

Admin can also track records of how many times an admin user logged in as a customer along with the login time and IP address. Not only this it also offers filter facility for each and every login.

<img src="https://kiwicommerce.co.uk/wp-content/uploads/2018/05/LoginAscustomerLog_New.png"/> <br/>

### Configuration

User can control or set where “Login as customer” link will be displayed using the Setting section that is given below.

<img src="https://kiwicommerce.co.uk/wp-content/uploads/2018/05/ConfigurationSetting.png" /> <br/>

## Contribution
Well unfortunately there is no formal way to contribute, we would encourage you to feel free and contribute by:
 
  - Creating bug reports, issues or feature requests on <a target="_blank" href="https://github.com/kiwicommerce/magento2-login-as-customer/issues">Github</a>
  - Submitting pull requests for improvements.
    
We love answering questions or doubts simply ask us in issue section. We're looking forward to hearing from you!
 
  - Follow us <a href="https://twitter.com/KiwiCommerce">@KiwiCommerce</a>
  - <a href="mailto:support@kiwicommerce.co.uk">Email Us</a>
  - Have a look at our <a href="https://kiwicommerce.co.uk/docs/login_as_customer/">documentation</a>
