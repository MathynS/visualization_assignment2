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
    #print("Counties freqs: {}".format(counties_freqs))
    grouped = dataframe.groupby("State")['County Code'].value_counts()
    print("Unique counties by state\n{}".format(grouped))
    #gframe = grouped.to_frame()
    #gframe = gframe.reset_index(level=['State', 'County Code'])
    #print(gframe)
#    for group in grouped.groups:
#        dgroup = grouped.groups[group]
#        dgroup_count = dgroup['County Code'].nunique()
#        print("{} has {} unique counties".format(group, dgroup_count))
    
    #print("States:\n{}".format(dataframe['State'].value_counts()))
