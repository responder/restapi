# Personal Fields

## Retrieve personal fields of list - By "GET" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /personal_fields

**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Optional) - Passed by Url query:** 

  | Name     | Description | Example     | Range    | DefaultValue | Invalid Values |
  | ---------|-------------|-------------|----------|--------------|----------------|
  | limit  | Maximum number of Views to be retrieved | limit=100 | 0 <= limit <= 500     | 500         | If parameter is not in range - default value will be used | 
  | offset | The position to start the count of "limit" from | offset=3 | offset >= 0     | 0         | |   

  
**Response Example:**

    {
       "LIST_ID" : 123456
       "PERSONAL_FIELDS" : [
          {
             "ID" : 2365,
             "NAME" : "City",
             "DEFAULT_VALUE" : "Tel Aviv",
             "DIR" : "rtl",
             "HIDDEN":"0",
             "TYPE" : 0
          },
          {
             "ID" : 2365,
             "NAME" : "Birth Date",
             "DEFAULT_VALUE" : "",
             "DIR" : "ltr",
             "HIDDEN":"1",
             "TYPE" : 1
          }
       ]
    }
    
## Create personal fields in list - By "POST" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /personal_fields

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Key     | Value | Example |
  | ---------|-------------|---------|
  | personal_fields | Array of Json objects with PersonalFields' data | See bellow the full Json example |

*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        [
           {
              "NAME" : "City",
              "DEFAULT_VALUE" : "Tel Aviv",
              "DIR" : "rtl",
              "TYPE" : 0,
           },
           {
              "NAME" : "Date of birth",
              "TYPE" : 1
           }
        ]

**Response Example:**

    {
       "LIST_ID" : 123456,
       "CREATED_PERSONAL_FIELDS" : [
          {4567 : "City"}
       ],
       "EXISTING_PERSONAL_FIELD_NAMES" : [
          {123 : "Date of birth"}
       ],
    }
    

## Update personal fields in list - By "PUT" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /personal_fields

**Method:** Put

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Name     | Description | Example | NOTE! |
  | ---------|-------------|---------|-------|
  | personal_fields | Array of Json objects with Personal fields' data to update | See bellow the full Json example | Updating "EMAIL_NOTIFY" or "AUTOMATION" will delete the previous records!
  
*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        [
           {
              "ID" : "123",
              "DEFAULT_VALUE" : "Tel Aviv-Jaffa"
           },
           {
              "ID" : "12341",
              "DIR" : "ltr"
           }
        ]

**Response Example:**

    {
       "LIST_ID" : 123456,
       "UPDATED_PERSONAL_FIELDS" : [123],
       "INVALID_PERSONAL_FIELD_IDS" : [12341],
       "EXISTING_PERSONAL_FIELD_NAMES" : []
    }
    

## Delete Personal fields in list - By "DELETE" request

**URL:** http://api.responder.co.il/main/lists/ + listId + /personal_fields

**Method:** Delete

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:

  | Key     | Value | Example     |
  | ---------|-------------|-------------|
  | personal_fields  | Array of personal-field ID's to be deleted | see LIST example bellow |
  
**Array of IDs and / or email - Example:**
        
        [
           {"ID": 123},
           {"ID": 45678}
        ]

**Response Example:**

    {
       "DELETED_FIELDS" : [123],
       "INVALID_FIELD_IDS" : [45678]
    }