<?php

function create($class, $attributes = [], $count = null)
{
    if ($count) {
        return factory($class, $count)->create($attributes);
    } else {
        return factory($class)->create($attributes);
    }
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}
