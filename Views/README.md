# Views

## Retrieve views of list - By "GET" request

**URL:** https://api.responder.co.il/main/lists/ + listId + /views

**Method:** Get

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Optional) - Passed by Url query:** 

  | Name     | Description | Example     | Range    | DefaultValue | Invalid Values | NOTE!                             |
  | ---------|-------------|-------------|----------|--------------|----------------|-----------------------------------|
  | limit  | Maximum number of Views to be retrieved | limit=100 | 0 <= limit <= 500     | 500         | If parameter is not in range - default value will be used | 
  | offset | The position to start the count of "limit" from | offset=3 | offset >= 0     | 0         | |   

**Response Example:**

    {
       "LIST_ID" : 123456
       "VIEWS" : [
          {
             "ID" : 8008,
             "NAME" : "Tel Aviv"
          },
          {
             "ID" : 457,
             "NAME" : "Car Owners"
          }
       ]
    }
    
## Create views in list - By "POST" request

**URL:** https://api.responder.co.il/main/lists/ + listId + /views

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:
  
  | Key     | Value | Example |
  | ---------|-------------|---------|
  | views | Array of Json objects with Views' names | See bellow the full Json example |

*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        [
           {
              "NAME" : "Tel Aviv"
           },
           {
              "NAME" : "Car Owners"
           }
        ]

**Response Example:**

    {
       "LIST_ID" : 123456,
       "VIEWS_CREATED" : [ 4567 , 4568 ]
    }
    

## Update views in list - By "PUT" request

**URL:** https://api.responder.co.il/main/lists/ + listId + /views

**Method:** Put

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameter (Required!):**
  
  The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:

  | Key     | Value | Example |
  | ---------|-------------|---------|
  | views | Array of Json objects with Views' data to update | Post data | See bellow the full Json example |

*The JSON object inside the value has to converted into a string*

**Json object of List's data Example:**
        
        [
           {
              "ID" : "123",
              "NAME" : "Tel Aviv-Jaffa"
           },
           {
              "ID" : "12341",
              "NAME" : "New Car Owners"
           }
        ]

**Response Example:**

    {
       "LIST_ID" : 123456,
       "UPDATED_VIEWS" : [123],
       "INVALID_VIEWS_IDS" : [12341]
    }
    

## Delete views in list - By "POST" request

**URL:** https://api.responder.co.il/main/lists/ + listId + /views

**Method:** Post

**Authentication:** Auth Data in headers. for more details [click here](https://github.com/responder/restapi/tree/master/Authentication/ )

**Parameters (Required!):**

The request body should be sent as `application/x-www-form-urlencoded` with the following parameters:

  | Key     | Value | Example     |
  | ---------|-------------|-------------|
  | method | "delete" value has to be passed | method="delete" | 
  | personal_fields  | Array of views ID's to be deleted | see example in list bellow |
  
**Array of IDs and / or email - Example:**
        
        [
           {"ID": 123},
           {"ID": 45678}
        ]

**Response Example:**

    {
       "DELETED_VIEWS" : [123],
       "INVALID_VIEW_IDS" : [45678]
    }