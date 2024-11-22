# About Project
This project is a solution for an assessment.

# Available API End-Points

## Quizzes

```http
GET /api/quizzes
```

#### Response
```javascript
{
    "data": [
        {
            "id": 58,
            "title": "Quiz",
            "description": "lorem ipsum",
            "created_at": "2024-11-21T18:20:24.000000Z"
        },
        ...
    ],
        "links": {
        "first": "https://assessment_1.test/api/quizzes?page=1",
            "last": "https://assessment_1.test/api/quizzes?page=4",
            "prev": null,
            "next": "https://assessment_1.test/api/quizzes?page=2"
    },
    "meta": {
        "current_page": 1,
            "from": 1,
            "last_page": 4,
            "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://assessment_1.test/api/quizzes?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "https://assessment_1.test/api/quizzes?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "https://assessment_1.test/api/quizzes?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "https://assessment_1.test/api/quizzes?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "https://assessment_1.test/api/quizzes?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
            "path": "https://assessment_1.test/api/quizzes",
            "per_page": 15,
            "to": 15,
            "total": 51
    }
}
```

## Quiz Response

```http
POST /api/quiz-responses
```

| Parameter  | Type      | Description                         |
|:-----------|:----------|:------------------------------------|
| `email`    | `string`  | **Required**. Email                 |
| `response` | `string`  | **Required**. Response              |
| `quiz_id`  | `integer` | **Required**. Quiz id to respond to |

#### Response
```javascript
{
    "success": true
}
```

# Tests
tests are located in `tests` folder and are written in [Pest](https://pestphp.com/), to run tests:

```bash
./vendor/bin/pest
```
