<?php
namespace wow{
    const abs = "wow1";
}

namespace {
    use wow as w;
    echo w::abs;
}