#!/usr/bin/env python
import argparse
import csv
parser = argparse.ArgumentParser(description="Count the number of different counties in the dataset")
parser.add_argument('-f', '--file', help="Input file", required=True)

if __name__ == '__main__':
    counties = []
    args = parser.parse_args()
    input_file = args.file
    with open(input_file, 'r') as csvfile:
        spamreader = csv.DictReader(csvfile, delimiter=',', quotechar='"')
        for row in spamreader:
            counties.append(row['County'] + "," + row['County Code'])
    print('name,code')
    print("\n".join(set(counties)))

