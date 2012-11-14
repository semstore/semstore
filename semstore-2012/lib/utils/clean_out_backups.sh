#! /bin/bash

find . -name \*.\*~ | xargs rm
find . -name ._\* | xargs rm

