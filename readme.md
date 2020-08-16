# Theme.id's Caldera Form to Slack 
**Contributors:**      themeid, hadie danker  
**Tags:**              caldera form,slack, api, chat, notification  
Author:            Theme.id
**Donate link:**       https://bit.ly/dankerizer  
**Requires at least:** 5.3  
**Tested up to:**      5.3  
**Stable tag:**        0.1.0  
Version:           0.1.0
**Requires PHP:**      7.2  
**License:**           GPLv2 or later  
**License URI:**       http://www.gnu.org/licenses/gpl-2.0.html  

Send notifications to Slack channels when certain on Caldera Form submission.


## Description 
Send notifications to [Slack](https://slack.com) channels when certain on Caldera Form submission.


## Installation 

1. Upload **Theme.id's Caldera Form to Slack** plugin to your blog's `wp-content/plugins/` directory and activate.
2. You also must install [Caldera Form](https://wordpress.org/plugins/caldera-forms/) to use **Caladea Slack**
3. Add new **Incoming WebHooks** service in your Slack, the URL is `https://<SUBDOMAIN>.com/services/new/incoming-webhook` (replace `<SUBDOMAIN>` with your Slack's subdomain). Once created, note the URL of the service (you'll set it into integration entry in your WordPress).
4. Create new Form in Caldera Forms
5. Add Processor **Caladea Slack**


## Input Field Usage 

* **Hook Url** for _Incoming WebHooks URL_ service in your Slack
* **Bot Name** The name of Bot that will be display in message
* **Channel Name** Overrides the default channel for this web hook (e.g #myChannel) or leave blank to use default
* **Icon** Icon (png, jpg file ) or [emoji](https://www.webfx.com/tools/emoji-cheat-sheet/)
* **Message Text** The message that gets sent to Slack. You can use markdown format and magic tag for your message

Tutorial in Indonesian Language


## Screenshots 

### 1. Integrations list. Yes, you can add more than one integration.
[missing image]

### 2. Your channel get notified on caldera form submission.
[missing image]



## Frequently Asked Questions 


### What is Slack 
Slack is an awesome team collaboration tool which is free and has a lot of API integrations to popular services.


### How to get Slack Hook URL 
1. You must have Slack channel
2. Go to Menu Slack Apps
3. Select **Incoming WebHooks" and add menu "Add to Slack"
4. Follow instruction from [Slack here](https://api.slack.com/custom-integrations)


###  Does the plugin disable email notification? 
No, you can add any notification processor in Caldera Form e.g Auto Responder


### I need help / i want to suggest something 
Please feel free to contact me at halo[AT]theme.id


### What is Caldera Form 
Caldera Form is a free and powerful WordPress plugin that creates responsive forms with a simple drag and drop editor. Caldera Forms has many free user-friendly add-ons for both beginners and web developers.


### How to add processor in Caldera Form 
1. Create a Form
2. open Processor tab in Form edit page
3. Click add processor button



## Privacy Policy  
Theme.id's Caldera Form to Slack uses [Appsero](https://appsero.com) SDK to collect some telemetry data upon user's confirmation. This helps us to troubleshoot problems faster & make product improvements.

Appsero SDK **does not gather any data by default.** The SDK only starts gathering basic telemetry data **when a user allows it via the admin notice**. We collect the data to ensure a great user experience for all our users.

Integrating Appsero SDK **DOES NOT IMMEDIATELY** start gathering data, **without confirmation from users in any case.**

Learn more about how [Appsero collects and uses this data](https://appsero.com/privacy-policy/).



## Upgrade Notice 
 Initial release



## Changelog 


### 0.1.0 
Initial release
