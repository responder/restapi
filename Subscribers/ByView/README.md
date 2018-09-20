# Subscribers

## Retrieve subscribers of view - By "GET" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /views/ + viewId + /subscribers

**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/chenrosenblum/my-description/tree/master/Authentication/ )

**Parameters (Optional) - Passed by Url query:**
  
  | Name     | Description | Example     | Range & Invalid Values |
  | ---------|-------------|-------------|------------------------|
  | limit | Maximum number of subscribers to be retrieved. | limit=100 | 0 <= limit <= 500. If parameter is not in range - default value will be used | 
  | offset  | The position to start the count of "limit" from | offset=1500 | offset >= 0

**Response Example:**

    [
        {
            "ID":"255094007",
            "DATE":"1536910254"
        }
    ]

## Associate existing subscribers to view - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /views/ + viewId + /subscribers

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/chenrosenblum/my-description/tree/master/Authentication/ )

**Parameter (Required!) - Passed By Post data:**
  
  | Name     | Description | Example |
  | ---------|-------------|---------|
  | subscribers | Array of Subscriber IDs | See bellow the full Object example |

*In post-data: The Json object has to be sent in json-encode variation*

**Subscriber IDs Example:**
        
    {
        "VIEW_SUBSCRIBERS_CREATED":
                {
                    "12345677":"subscriberemail@gmail.com",
                    "77654321":"anothersubemail@gmail.com"
                },
        "VIEW_SUBSCRIBERS_EXISTING":[],
        "INVALID_SUBSCRIBER_IDS":[],
        "INVALID_SUBSCRIBER_EMAILS":[],
        "ERRORS":[]}
    }

**Response Example:**

    {
       "VIEW_SUBSCRIBERS_CREATED" : ["32"],
       "VIEW_SUBSCRIBERS_EXISTING" : ["45"],
       "INVALID_SUBSCRIBERS_IDS" : ["888"],
       "ERRORS" : []
    }
    
## Delete Subscribers from view - By "DELETE" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /views/ + viewId + /subscribers

**Method:** Delete

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/chenrosenblum/my-description/tree/master/Authentication/ )

**Parameters (Required!) - Passed By Post data:**

  | Name     | Description | Example     |
  | ---------|-------------|-------------|
  | subscribers  | Array of IDs and / or email address to be deleted from view | see example in list bellow |
  
**Array of IDs and / or email - Example:**
        
        [
           {"ID" : 123},
           {"ID" : 456},
           {"EMAIL" : "responder@responder.co.il"},
           {"EMAIL" : "not@valid"},
           {"EMAIL" : "email_not@list.com"}
        ]

**Response Example:**

    {
       "INVALID_SUBSCRIBER_IDS" : [123],
       "INVALID_SUBSCRIBER_EMAILS" : ["not@valid", "email_not@list.com"],
       "DELETED_VIEW_SUBSCRIBERS" : [
          "456",
          "responder@responder.co.il"
       ]
    }

