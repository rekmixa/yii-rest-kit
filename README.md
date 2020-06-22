# Basics

## Installation

```
make install
```

## Migrations

### Apply migrations for main database

```
make migrate-main
```

### Apply migrations for test database

```
make migrate-test
```

### Apply migrations for all databases

```
make migrate
```

## Refresh migrations for main database

```
make migrate-fresh-main
```

## Refresh migrations for test database

```
make migrate-fresh-test
```

## Refresh migrations for all databases

```
make migrate-fresh
```

## Composer

```
make composer-install
```

```
make composer-update
```

```
make composer-update-lock
```

## Start

```
make up
```

## Stop

```
make down
```

# CLI

## Create user

```
./yii user/create -u=USERNAME -p=PASSWORD -s=STATUS
```

## Show users list

```
./yii user/list -l=LIMIT -o=OFFSET --ids=IDS
```

#### Example value of ids argument: 1,2,3

## Update user

```
./yii user/update --id=UESR_ID -u=NEW_USERNAME -p=NEW_PASSWORD -s=NEW_STATUS
```

## Delete user

```
./yii user/delete --id=USER_ID
```
