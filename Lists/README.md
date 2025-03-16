# Lists

## Retrieve lists - By "GET" request

**URL:** https://api.responder.co.il/main/lists

**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Optional) - Passed By Url query:**
  
  | Name     | Description | Example     | Range    | DefaultValue | Invalid Values | NOTE!                             |
  | ---------|-------------|-------------|----------|--------------|----------------|-----------------------------------|
  | list_ids | list of ListID's to be retrieved | list_ids=123456,78910 | none     | none         | Invalid ID's will be returned in a JSON array of "INVALID_LIST_IDS" | When used with "limit" or "offset" results are unpredictable
  | limit  | Maximum number of Lists to be retrieved | limit=100 | 0 <= limit <= 500     | 500         | If parameter is not in range - default value will be used | 
  | offset | The position to start the count of "limit" from | offset=3 | offset >= 0     | 0         | |   

**Response Example:**

    {
       "LISTS" : [
          {
             "ID" : 123456,
             "DESCRIPTION" : "The List",
             "REMOVE_TITLE" : "Bye Bye!",
             "SITE_NAME" : "Responder!",
             "SITE_URL" : "http://www.esponder.co.il",
             "LOGO" : "http://www.responder.co.il/images/wn_06.gif",
             "SENDER_NAME" : "Someone",
             "SENDER_EMAIL" : "someone@responder.co.il",
             "SENDER_ADDRESS" : "Somewhere At Responder",
             "NAME" : "english_name",
             "AUTH_MAIL_SUBJECT" : "",
             "AUTH_MAIL_BODY" : "",
             "AUTH_MAIL_LINK" : "",
             "AUTH_MAIL_DIR" : "",
             "AUTH_MAIL_PAGE" : "",
             "AUTH_MAIL_FORM" : "",
             "AUTH_MAIL_MANUAL" : "",
             "EMAIL_NOTIFY" : {
                "first@responder.co.il",
                "second@responder.co.il"
             },
             "AUTOMATION" : {
                123457 : "First List",
                123458 : "Another List"
             }
          }
       ],
       "INVALID_LIST_IDS" : [456]
    }
    
    

## Create a list - By "POST" request

**URL:** https://api.responder.co.il/main/lists

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:

  | Key     | Value | Example |
  | ---------|-------------|---------|
  | info | Json object with List's data | See bellow the full Json example |

*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        {
           "DESCRIPTION" : "The List",
           "REMOVE_TITLE" : "Bye Bye!",
           "SITE_NAME" : "Responder!",
           "SITE_URL" : "http://www.esponder.co.il",
           "LOGO" : "http://www.responder.co.il/images/wn_06.gif",
           "SENDER_NAME" : "Someone",
           "SENDER_EMAIL" : "someone@responder.co.il",
           "SENDER_ADDRESS" : "Somewhere At Responder",
           "NAME" : "english_name",
           "AUTH_MAIL_SUBJECT" : "",
           "AUTH_MAIL_BODY" : "",
           "AUTH_MAIL_LINK" : "",
           "AUTH_MAIL_DIR" : "",
           "AUTH_MAIL_PAGE" : "",
           "AUTH_MAIL_FORM" : "",
           "AUTH_MAIL_MANUAL" : "",
           "EMAIL_NOTIFY" : ["first@responder","second@responder.co.il"],
           "AUTOMATION" : [123457,123458]
        }

**Response Example:**

    {
       "LIST_ID" : 123456789,
       "INVALID_EMAIL_NOTIFY" : ["second@responder"],
       "INVALID_LIST_IDS" : [123458],
       "ERRORS" : []
    }
    

## Update a list - By "PUT" request

**URL:** https://api.responder.co.il/main/lists/ + listIdToUpdate

**Method:** Put

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Key     | Value | Example | NOTE! |
  | ---------|-------------|---------|-------|
  | info | Json object with List's data to update | See bellow the full Json example | Updating "EMAIL_NOTIFY" or "AUTOMATION" will delete the previous records!
  
*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        {
           "DESCRIPTION" : "The new description for the List",
           "REMOVE_TITLE" : "See you!",
           "SITE_NAME" : "Responder!",
           "SITE_URL" : "http://www.esponder.co.il",
           "LOGO" : "http://www.responder.co.il/images/wn_06.gif",
           "SENDER_NAME" : "Someone",
           "SENDER_EMAIL" : "someone@responder.co.il",
           "SENDER_ADDRESS" : "Somewhere At Responder",
           "NAME" : "english_name",
           "AUTH_MAIL_SUBJECT" : "",
           "AUTH_MAIL_BODY" : "",
           "AUTH_MAIL_LINK" : "",
           "AUTH_MAIL_DIR" : "",
           "AUTH_MAIL_PAGE" : "",
           "AUTH_MAIL_FORM" : "",
           "AUTH_MAIL_MANUAL" : "",
           "EMAIL_NOTIFY" : ["first@responder","second@responder.co.il"],
           "AUTOMATION" : [999009]
        }

**Response Example:**

    {
       "INVALID_EMAIL_NOTIFY" : [],
       "INVALID_LIST_IDS" : [],
       "ERRORS" : []
    }
    

## Delete a list - By "DELETE" request

**URL:** https://api.responder.co.il/main/lists/ + listIdToDelete

**Method:** Delete

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters:** None

**Response Example:**

    {
       "DELETED_LIST_ID" : 654987
    }