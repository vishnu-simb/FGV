<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/1/14
 * Time: 11:40 AM
 *
 * contain all constants for this app
 */
class AppConst
{
    // for deleted status
    const DELETED_FALSE = 0;
    const DELETED_TRUE = 1;
    const DELETED_PERMANENTLY = -1;

    // saving to database
    const SAVE_DB_VALIDATION_FAILED = 101;
    const SAVE_DB_DUPLICATED_ITEM = 102;

    // default text
    const DEFAULT_FIRST_NAME = "FirstName";
    const DEFAULT_LAST_NAME = "LastName";

    // General status
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = -1;

    // User status
    const USER_ACTIVE = 1;
    const USER_DISABLED = -1;
}