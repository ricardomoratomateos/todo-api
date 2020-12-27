# Todo API

A simple API following the hexagonal/clean architecture pattern

# How to execute it

First of all, install dependencies
```bash
$ composer install
```

Open and fill the .env file. By default, the API uses the port 8080. If you want to use another port, only change it. 

Then, run (and build) the dockers
```bash
$ composer docker:build
$ composer docker:run
```

And finally, call to health endpoint. If not error is returned is because all works as expected
```bash
$ curl --location --request GET 'http://localhost:8080/health'
```

# How to execute tests

First of all, install dependencies if them are not installed
```bash
$ composer install
```

Then, you can run all the tests or only the unit or integration tests
```bash
$ composer test
$ composer test:unit
$ composer test:integration
$ composer test:coverage
```

# How to stop the API

```bash
$ composer docker:stop
$ composer docker:destroy
```

# Extra

### Check code styles
```bash
$ composer code:style
```

### Fix code styles
```bash
$ composer fix:code:style
```
