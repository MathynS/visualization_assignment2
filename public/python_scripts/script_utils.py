#!/usr/bin/env python

import os

def debug(content, show_content):
    if show_content:
        print("(DEBUG) {}".format(content))


def files(path):
    for f in os.listdir(path):
        if os.path.isfile(os.path.join(path, f)):
            yield f

def create_filename(directory, filename):
    if directory.endswith('/'):
        return directory + filename
    return directory + "/" + filename
        
