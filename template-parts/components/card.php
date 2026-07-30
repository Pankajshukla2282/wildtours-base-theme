<?php

$post = $args['post'] ?? null;

if (!$post instanceof WP_Post) {
    return;
}