**Key Value Store with Laravel**
----
  <_This Laravel build implements a basic Key Value store using Predis. The REST API solution provides option for retrieving list of data, inserting data and updating data.._>

* **URL**

  <_base_url/api/_>

* **Method:**
  
  <_The request type_>

  `GET` | `POST` | `PATCH` 
  
*  
**Show All Value in The Store**
----
  Returns json data about a all existing values in the store.

* **URL**

  /values

* **Method:**

  `GET`
  

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"status":"OK","count":3,"data":{"key1":"anik","key3":"test","k3ey2":"test"}}`
    
**Show Specific Value in The Store**
----
  Returns json about value of specific key passed in the URL Parameter.

* **URL**

  /values

* **Method:**

  `GET`
  

* **Data Params**

  keys=key1

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"status":"OK","count":1,"data":{"key1":"anik"}}`
    
 **Update Value by Key:**
----
  Returns json about status of requested updates of values by key.

* **URL**

  /values

* **Method:**

  `PATCH`
  

* **Data Params**

  {"key1": "anik", "k3ey2": "adsasd", "key3": "tasdest"}

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{
    "status": "OK",
    "updated_count": 3,
    "data": {
        "key1": "anik",
        "k3ey2": "adsasd",
        "key3": "tasdest"
    }
}`
 
