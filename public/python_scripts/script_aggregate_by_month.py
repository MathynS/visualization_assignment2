#!/usr/bin/env python

import pandas as pd
from statistics import median
import argparse
from script_utils import debug
from script_utils import files
from script_utils import create_filename

DELTA_DEBUG = 100
DEBUG = True
COUNTY_CODE_COLUMN = 'County Code'
DATE_LOCAL_COLUMN = 'Date Local'
STATE_CODE_COLUMN = 'State Code'
INFO_COLUMNS = ['State Code', 'County Code', 'Site Num', 'Address',
                'State', 'County', 'City', 'Date Local', 'NO2 Units',
                'O3 Units', 'SO2 Units', 'CO Units']

NUMERIC_COLUMNS = ['NO2 Mean', 'NO2 1st Max Value', 'NO2 1st Max Hour', 'NO2 AQI',
                   'O3 Mean', 'O3 1st Max Value', 'O3 1st Max Hour', 'O3 AQI',
                   'SO2 Mean', 'SO2 1st Max Value', 'SO2 1st Max Hour', 'SO2 AQI',
                   'CO Mean', 'CO 1st Max Value', 'CO 1st Max Hour', 'CO AQI']

MONTHS = ['01', '02', '03', '04', '05', '06',
          '07', '08', '09', '10', '11', '12']

parser = argparse.ArgumentParser(description='Remove duplicates from csv files in idir and writes the new files into odir')
parser.add_argument('--idir', help="Input directory", required=True)
parser.add_argument('--odir', help="Output directory", required=True)

def aggregate_rows_by_median(rows, state_code, county_code, date_local):

    row_dict = {}
    
    for column in INFO_COLUMNS:
        for index_row, row in rows.head(1).iterrows():
            if column == DATE_LOCAL_COLUMN:
                row_dict[column] = row[column][:7] + "-01"
            else:
                row_dict[column] = row[column]
        
    
    for column in NUMERIC_COLUMNS:
        values = []
        for index_row, row in rows[[column, STATE_CODE_COLUMN, COUNTY_CODE_COLUMN, DATE_LOCAL_COLUMN]].iterrows():
            if row[STATE_CODE_COLUMN] == state_code and row[COUNTY_CODE_COLUMN] == county_code and row[DATE_LOCAL_COLUMN].startswith(date_local):
                if not pd.isna(row[column]):
                    values.append(row[column])
            else:
                debug("state_code_column: {}, county_code_column: {}, date_local_column: {}".format(row[STATE_CODE_COLUMN],
                                                                                                    row[COUNTY_CODE_COLUMN],
                                                                                                    row[DATE_LOCAL_COLUMN]), DEBUG)
                debug("state_code: {}, county_code: {}, date_local: {}".format(state_code, county_code, date_local), DEBUG)
                debug(row, DEBUG)
                #print("unexpected value for row")

        if len(values) >= 1:
            row_dict[column] = median(values)
        else:
            row_dict[column] = 'NaN'

    return row_dict
            
                
def remove_duplicates(original_dataframe):
    state_county_and_dates = original_dataframe[[STATE_CODE_COLUMN, COUNTY_CODE_COLUMN, DATE_LOCAL_COLUMN]]

    state_county_and_dates[DATE_LOCAL_COLUMN] = state_county_and_dates[DATE_LOCAL_COLUMN].str.slice(0, 7)
    #debug(county_and_dates, DEBUG)
    unique_state_county_and_dates = state_county_and_dates.drop_duplicates()
    #debug(unique_county_and_dates, DEBUG)
    new_dataframe = pd.DataFrame(columns = original_dataframe.columns)

    row_counter = 1
    for row_index, row in unique_state_county_and_dates.iterrows():
        sliced_dataframe = original_dataframe[(original_dataframe[STATE_CODE_COLUMN] == row[STATE_CODE_COLUMN]) & (original_dataframe[COUNTY_CODE_COLUMN] == row[COUNTY_CODE_COLUMN]) & (original_dataframe[DATE_LOCAL_COLUMN].str.slice(0, 7) == row[DATE_LOCAL_COLUMN])]
        rdict = aggregate_rows_by_median(sliced_dataframe,
                                         row[STATE_CODE_COLUMN],
                                         row[COUNTY_CODE_COLUMN],
                                         row[DATE_LOCAL_COLUMN])
        new_dataframe = new_dataframe.append(rdict, ignore_index=True)

        
        if row_counter % DELTA_DEBUG == 0:
            debug("row number: {}".format(row_counter), DEBUG)
        row_counter += 1
        
    return new_dataframe
    

if __name__ == '__main__':
    args = parser.parse_args()
    input_directory = args.idir
    output_directory = args.odir

    for f in files(input_directory):
        input_filename = create_filename(input_directory , f)
        debug(input_filename, DEBUG)
        original_dataframe = pd.read_csv(input_filename)
        new_dataframe = remove_duplicates(original_dataframe)
        output_filename = create_filename(output_directory,  f)
        debug(output_filename, DEBUG)
        new_dataframe.to_csv(output_filename, index=False)
