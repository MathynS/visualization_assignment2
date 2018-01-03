#!/usr/bin/env python

import pandas as pd
import argparse

parser = argparse.ArgumentParser(description="Count the number of different counties in the dataset")
parser.add_argument('--ifile', help="Input file", required=True)

if __name__ == '__main__':
    args = parser.parse_args()
    input_file = args.ifile

    dataframe = pd.read_csv(input_file)
    print(dataframe.columns)
    count = dataframe['County Code'].nunique()
    counties_freqs = dataframe['County Code'].value_counts()
    print("Number of unique counties: {}".format(count))
    print("Counties freqs: {}".format(counties_freqs))

