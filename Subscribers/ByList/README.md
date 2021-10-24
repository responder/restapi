# Subscribers

## Retrieve subscribers from list - By "GET" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /subscribers

**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Optional) - Passed by Url query:**
  
  | Name     | Description | Example     | Range & Invalid Values |
  | ---------|-------------|-------------|------------------------|
  | limit | Maximum number of subscribers to be retrieved. | limit=100 | 0 <= limit <= 500. If parameter is not in range - default value will be used | 
  | offset  | The position to start the count of "limit" from | offset=1500 | offset >= 0
  | dir | The order of the subscribers. 0 = ascending order, 1 = descending order - according to subscription date.  | dir=1 | 0 / 1     | |   
  | subscriber_id  | The identity of specific subscriber (Value can be either id or email) | subscriber_id=123456 / subscriber_id=israeli@gmail.com  | any number or string    | |   
  | min_join_date  | The minimum for subscription date of subscriber | min_join_date=2015-01-01 00:00 | Value has to be a valid date in "YYYY-MM-DD HH:mm" format. If parameter is not a valid date / format - error message will be returned | 
  | max_join_date  | The maximum for subscription date of subscriber | max_join_date=2018-06-30 00:00 | Value has to be a valid date in "YYYY-MM-DD HH:mm" format. If parameter is not a valid date / format - error message will be returned |

**Response Example:**

    [
        {
            "ID":"123456",
            "NAME":"Subscriber name",
            "EMAIL":"subscriber@gmail.com",
            "PHONE":"0544444444",
            "STATUS":"1",
            "STATUS_NUM":"0",
            "DAY":"10",
            "JOIN_DATE":"2020-02-20 22:22",
            "OFFSET":"0",
            "LAST_OPEN":"0",
            "PERSONAL_FIELDS":[
                {
                   123456 : "Responder",
                   654321 : "Newsletter Service"
                }]
        }
    ]

## Create subscribers in list - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /subscribers

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!) - Passed By Post data:**
  
  | Name     | Description | Example |
  | ---------|-------------|---------|
  | subscribers | Json object with Subscribers' data | See bellow the full Json example |

*In post-data: The Json object has to be sent in json-encode variation*

**Json object of List's data Example:**
        
        [
           {
              "NAME" : "John Smith",
              "EMAIL" : "johnsmith@gmail.com",
              "PHONE" : "04-23456789",
              "DAY" : 12,
              "NOTIFY" : 2 // parameter for email's notification for the user about new subscriber. (0 - don't notify / 1 - notify / 2 - according to list's settings)
           },
           {
              "NAME" : "Bob Jones",
              "EMAIL" : "bobjones@yahoo.com",
              "PHONE" : "03-87654321",
              "PERSONAL_FIELDS" : {
                 3 : "Tel Aviv",
                 49 : "Honda Civic"
              }
              "NOTIFY": 0  // parameter for email's notification for the user about new subscriber. (0 - don't notify / 1 - notify / 2 - according to list's settings)
           }
        ]

**Response Example:**

    {
       "SUBSCRIBERS_CREATED" : [123],
       "EMAILS_INVALID" : [],
       "EMAILS_EXISTING" : ["johnsmith@gmail.com"],
       "EMAILS_BANNED" : [],
       "PHONES_INVALID" : [],
       "PHONES_EXISTING" : [],
       "BAD_PERSONAL_FIELDS" : {
          123 : {
             3 : "Tel Aviv"
          }
       },
       "ERRORS" : []
    }
    

## Update subscribers in list - By "PUT" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /subscribers

**Method:** Put

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!) - Passed By Post data:**
  
  | Name     | Description | Example | NOTE! |
  | ---------|-------------|---------|-------|
  | subscribers | Json object with Subscribers' data to update | See bellow the full Json example | Updating "EMAIL_NOTIFY" or "AUTOMATION" will delete the previous records!
  
*In post-data: The Json object has to be sent in json-encode variation*

**Json object of List's data Example:**
        
        [
           {
              "IDENTIFIER" : "js@gmail.com",
              "EMAIL" : "johnsmith@gmail.com",
              "NAME" : "John Smith",
              "PHONE" : "04-23456789",
              "DAY" : 12
           },
           {
              "IDENTIFIER" : 123,
              "NAME" : "Bob Jones",
              "PHONE" : "03-87654321",
              "PERSONAL_FIELDS" : {
                 3 : "Tel Aviv",
                 49 : "Honda Civic"
              }
           }
        ]

**Response Example:**

    {
       "SUBSCRIBERS_UPDATED" : [123],
       "INVALID_SUBSCRIBER_IDENTIFIERS" : [],
       "EMAILS_INVALID" : [],
       "EMAILS_EXISTED" : ["johnsmith@gmail.com"],
       "EMAILS_BANNED" : [],
       "PHONES_INVALID" : [],
       "PHONES_EXISTING" : [],
       "BAD_PERSONAL_FIELDS" : {
         123 : {
            3 : "Tel Aviv"
         }
      }
    }
    
## Delete Subscribers from list - By "DELETE" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /subscribers

**Method:** Delete

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!) - Passed By Post data:**

  | Name     | Description | Example     |
  | ---------|-------------|-------------|
  | subscribers  | Array of IDs and / or email address to be deleted | see example in list bellow |
  
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
       "DELETED_SUBSCRIBERS" : {
          4433 : "responder@responder.co.il",
          456 : "someone@responder.co.il"
       }
    }
