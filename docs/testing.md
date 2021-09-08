## Testing Guidelines 🧪
Portal uses Cypress for automated testing.

Steps to run cypress:

1. Copy `cypress.json.example` as `cypress.json`.
 For more configuration options please refer [here](https://docs.cypress.io/guides/references/configuration#cypress-json) 


2. Run the following command to run cypress 
    - Headless mode  
        ```
        yarn run cypress
        ```
    - GUI mode 
        ```
        yarn run cypress open
        ```