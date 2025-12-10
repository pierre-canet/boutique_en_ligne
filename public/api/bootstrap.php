<?php
// public/api/bootstrap.php
session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../core/database.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../models/user_model.php';
require_once __DIR__ . '/../../models/products_model.php';