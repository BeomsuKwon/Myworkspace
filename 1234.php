<?php
const   url         = 'localhost',
        user        = 'garaage',
        password    = 'garaage',
        db_name     = 'bbomi';

$conn = new mysqli(url, user, password, db_name);

$conn.query("INSERT INTO bbomi (path, state, category)
            VALUES");