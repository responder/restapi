# Messages

## Retrieve messages from list - By "GET" request

**URL for few messages:** http://api.responder.co.il/main/lists/ + listId + /messages

**URL for specific message:** http://api.responder.co.il/main/lists/ + listId + /messages/ + messageId


**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Optional) - Passed by Url query:**
  
  | Name     | Description | Example     | Range & Invalid Values |
  | ---------|-------------|-------------|------------------------|
  | limit | Maximum number of subscribers to be retrieved. | limit=100 | 0 <= limit <= 500. If parameter is not in range - default value will be used | 
  | offset  | The position to start the count of "limit" from | offset=1500 | offset >= 0
  | type | Array of message's type to be retrieved.  | see Json example bellow | 0 <=  type <= 4     | |   

**Type's array Example:**

    ["0","2"]

**Response Example:**

    [
      {
        "ID": "1234567",
        "TYPE": "1",
        "MODIFIED": "0",
        "SUBJECT": "message-subject",
        "BODY_TYPE": "5",
        "BODY": "<html>",
        "BODY_ALT": "",
        "BODY_XML": "",
        "VIEW_ID": "0",
        "XTEMPLATE_ID": "0",
        "AB_TESTING_ID": "0",
        "AB_TESTING_PERCENT": "0",
        "REFRESH_LIST": false,
        "LISTS_INCLUDED": [],
        "LISTS_EXCLUDED": [],
        "EXT_MSG_OPENED": "0",
        "POSTED": null,
        "SMS_POSTED": null,
        "FAILED": null,
        "OPENED": null,
        "RETURNED": null,
        "REMOVED": null,
        "COMPLAINED": null,
        "LINKED": null,
        "INTEVAL": "0",
        "ORDER": "0",
        "SEND_DATE": null,
        "IN_QUEUE": "0"
      }
    ]
    

## Create message in list - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /messages

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )


**Parameters (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Key     | Value | Example |
  | ---------|-------------|---------|
  | info | JSON object with Message's data | See bellow the full JSON example |

*The JSON object inside the value has to converted into a string*

**JSON object of Message's data Example:**

       {
          "TYPE" : "1", // 1 for "messer boded", 0 for "sidrat messarim", 2 for "mevusas ta'arich"
          "BODY_TYPE" : "0", // 0 for regular HTML editor (affects the type of editor used in the website)
          "SUBJECT" : 'message subject2',
          "BODY" : 'message HTML body',
          "FILTER" : "123", // -optional- the view id "kvuzat mishloah"
          'LANGUAGE' : "hebrew", // -optional- defaults to 'english'
          'CHECK_LINKS' : "1"
       }

**Response Example:**

    {
       "ERRORS":[],
       "MESSAGE_ID": 123456
    }
 

## Update message in list - By "PUT" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /messages/ + messageId

**Method:** Put

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Key     | Value | Example | Notice! |
  | ---------|-------------|---------|---------|
  | info | JSON object with Message's data | See bellow the full JSON example | JSON object must have "ID" attribute for applying the update

*The JSON object inside the value has to converted into a string*

**JSON object of Message's data Example:**

       {
          "ID" : "12345", // This attribute is mandatory for update!
          "TYPE" : "1", // 1 for "messer boded", 0 for "sidrat messarim", 2 for "mevusas ta'arich"
          "BODY_TYPE" : "0", // 0 for regular HTML editor (affects the type of editor used in the website)
          "SUBJECT" : 'message subject2',
          "BODY" : 'message HTML body',
          "FILTER" : "123", // -optional- the view id "kvuzat mishloah"
          "LANGUAGE" : "hebrew", // -optional- defaults to 'english'
          "CHECK_LINKS" : "1"
       }

**Response Example:**

    {
       "ERRORS": [],
       "MESSAGE_ID": 123456
    }
    

## Test sending a message - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /messages/ + messageId + /test

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!):**
  
  | Key     | Value | Example |
  | ---------|-------------|---------|
  | data | JSON object with Tester's data | See bellow the full JSON example |

*The JSON object inside the value has to converted into a string*

**JSON object of List's data Example:**

       {
          "name" : "your name"
          "email" : "emailfortesting@email.com"
          "phone" : '0500000000',
          "personal_fields" : [
            {123:'abcde'}
          ]
       }

**Response Example:**

    {
       "status": true
    }


## Send a message - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /messages/ + messageId

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters:** None

**Response Example:**

    {
       "MESSAGE_SENT": true
    }
   
## Delete messages from list - By "DELETE" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /messages

**Method:** Delete

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:

  | Key     | Value | Example     |
  | ---------|-------------|-------------|
  | messages_ids  | Array of Messages IDs to be deleted | see example in list bellow |
  
**Array of IDs and / or email - Example:**
        
    ["32","45","888"]

**Response Example:**

    {
       "INVALID_MESSAGE_IDS" : [45],
       "DELETED_MESSAGES" : [32, 888]
    }
