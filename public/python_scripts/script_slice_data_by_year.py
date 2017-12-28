#!/usr/bin/env python

import pandas as pd
import argparse
from script_utils import debug

DELTA_DEBUG = 100
DEBUG = True

DATE_LOCAL_COLUMN = 'Date Local'
DATES = ['2000', '2001', '2002', '2003', '2004', '2005',
         '2006', '2007', '2008', '2009', '2010', '2011',
         '2012', '2013', '2014', '2015', '2016']


parser = argparse.ArgumentParser(description='Remove duplicates from csv file grouping by County Code and Date Local')
parser.add_argument('--ifile', help="Input csv file", required=True)
parser.add_argument('--ofile', help="Output csv file", required=True)
                
def slice_dataframe(original_dataframe, output_filename_base):
    for year in DATES:
        sliced_dataframe = original_dataframe[original_dataframe[DATE_LOCAL_COLUMN].str.startswith(year)]
        debug("year: {}".format(year), DEBUG)
        output_filename = output_filename_base + str(year) + ".csv"
        sliced_dataframe.to_csv(output_filename, index=False)
        
if __name__ == '__main__':
    args = parser.parse_args()
    original_dataframe = pd.read_csv(args.ifile)
    new_dataframe = slice_dataframe(original_dataframe, args.ofile)
