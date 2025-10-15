// Nepali Date Converter - JavaScript version
// Based on the TypeScript library from subeshb1/Nepali-Date

// Date configuration mapping
const dateConfigMap = {
  '2000': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2001': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2002': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2003': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2004': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2005': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2006': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2007': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2008': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 29, Chaitra: 31 },
  '2009': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2010': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2011': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2012': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2013': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2014': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2015': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2016': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2017': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2018': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2019': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2020': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2021': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2022': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2023': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2024': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2025': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2026': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2027': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2028': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2029': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 32, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2030': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2031': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2032': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2033': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2034': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2035': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 29, Chaitra: 31 },
  '2036': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2037': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2038': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2039': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2040': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2041': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2042': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2043': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2044': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2045': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2046': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2047': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2048': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2049': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2050': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2051': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2052': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2053': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2054': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2055': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2056': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 32, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2057': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2058': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2059': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2060': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2061': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2062': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2063': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2064': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2065': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2066': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 29, Chaitra: 31 },
  '2067': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2068': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2069': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2070': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 29, Mangsir: 30, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2071': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2072': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2073': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2074': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2075': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2076': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2077': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2078': { Baisakh: 31, Jestha: 31, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2079': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2080': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2081': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2082': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2083': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2084': { Baisakh: 31, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 29, Falgun: 30, Chaitra: 31 },
  '2085': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 29, Chaitra: 31 },
  '2086': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 29, Poush: 30, Magh: 29, Falgun: 30, Chaitra: 30 },
  '2087': { Baisakh: 31, Jestha: 31, Asar: 32, Shrawan: 31, Bhadra: 31, Aswin: 31, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 30, Chaitra: 30 },
  '2088': { Baisakh: 30, Jestha: 31, Asar: 32, Shrawan: 32, Bhadra: 30, Aswin: 31, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 30, Chaitra: 30 },
  '2089': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 30, Chaitra: 30 },
  '2090': { Baisakh: 30, Jestha: 32, Asar: 31, Shrawan: 32, Bhadra: 31, Aswin: 30, Kartik: 30, Mangsir: 30, Poush: 29, Magh: 30, Falgun: 30, Chaitra: 30 }
};

// Constants
const EPOCH_YEAR = 2000;
const COMPLETED_DAYS = 1;
const TOTAL_DAYS = 0;
const MAX_DAY = 33238;
const MIN_DAY = 1;

// Begin English date (epoch)
const beginEnglish = {
  year: 1943,
  month: 3,
  date: 13,
  day: 3
};

// Format object for Nepali and English
const formatObj = {
  en: {
    day: {
      short: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      long: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    },
    month: {
      short: ['Bai', 'Jes', 'Asa', 'Shr', 'Bhd', 'Asw', 'Kar', 'Man', 'Pou', 'Mag', 'Fal', 'Cha'],
      long: ['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Aswin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra']
    },
    date: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
  },
  np: {
    day: {
      short: ['आइत', 'सोम', 'मंगल', 'बुध', 'बिहि', 'शुक्र', 'शनि'],
      long: ['आइतबार', 'सोमबार', 'मंगलबार', 'बुधबार', 'बिहिबार', 'शुक्रबार', 'शनिबार']
    },
    month: {
      short: ['बै', 'जे', 'अ', 'श्रा', 'भा', 'आ', 'का', 'मं', 'पौ', 'मा', 'फा', 'चै'],
      long: ['बैशाख', 'जेठ', 'असार', 'श्रावण', 'भाद्र', 'आश्विन', 'कार्तिक', 'मंसिर', 'पौष', 'माघ', 'फाल्गुण', 'चैत्र']
    },
    date: ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९']
  }
};

// Helper functions
function getYearIndex(year) {
  return year - EPOCH_YEAR;
}

function getYearFromIndex(yearIndex) {
  return yearIndex + EPOCH_YEAR;
}

function mod(m, val) {
  while (val < 0) {
    val += m;
  }
  return val % m;
}

// Initialize year month days mapping
const yearMonthDaysMapping = Object.values(dateConfigMap).map((year) => Object.values(year));

// Initialize month days mappings
const monthDaysMappings = yearMonthDaysMapping.map((yearMappings) => {
  let daySum = 0;
  return yearMappings.map((monthDays) => {
    const monthPassedDays = [monthDays, daySum];
    daySum += monthDays;
    return monthPassedDays;
  });
});

// Initialize year days mapping
let daysPassed = 0;
const yearDaysMapping = yearMonthDaysMapping.map((yearMappings) => {
  const daysInYear = yearMappings.reduce((acc, x) => acc + x, 0);
  const yearDaysPassed = [daysInYear, daysPassed];
  daysPassed += daysInYear;
  return yearDaysPassed;
});

// Core conversion functions
function findPassedDays(year, month, date) {
  try {
    const yearIndex = getYearIndex(year);
    const pastYearDays = yearDaysMapping[yearIndex][COMPLETED_DAYS];
    const extraMonth = mod(12, month);
    const extraYear = Math.floor(month / 12);

    const pastMonthDays =
      yearDaysMapping[yearIndex + extraYear][COMPLETED_DAYS] -
      pastYearDays +
      monthDaysMappings[yearIndex + extraYear][extraMonth][COMPLETED_DAYS];

    const daysPassed = pastYearDays + pastMonthDays + date;
    if (daysPassed < MIN_DAY || daysPassed > MAX_DAY) {
      throw new Error();
    }
    return daysPassed;
  } catch {
    throw new Error("The date doesn't fall within 2000/01/01 - 2090/12/30");
  }
}

function mapDaysToDate(daysPassed) {
  if (daysPassed < MIN_DAY || daysPassed > MAX_DAY) {
    throw new Error(`The epoch difference is not within the boundaries ${MIN_DAY} - ${MAX_DAY}`);
  }

  const yearIndex = yearDaysMapping.findIndex(
    (year) =>
      daysPassed > year[COMPLETED_DAYS] && daysPassed <= year[COMPLETED_DAYS] + year[TOTAL_DAYS]
  );
  const monthRemainder = daysPassed - yearDaysMapping[yearIndex][COMPLETED_DAYS];
  const monthIndex = monthDaysMappings[yearIndex].findIndex(
    (month) =>
      monthRemainder > month[COMPLETED_DAYS] &&
      monthRemainder <= month[COMPLETED_DAYS] + month[TOTAL_DAYS]
  );
  const date = monthRemainder - monthDaysMappings[yearIndex][monthIndex][COMPLETED_DAYS];

  return {
    year: getYearFromIndex(yearIndex),
    month: monthIndex,
    date: date
  };
}

function findPassedDaysAD(year, month, date) {
  const timeDiff = Date.UTC(year, month, date) - Date.UTC(beginEnglish.year, beginEnglish.month, beginEnglish.date);
  const diffDays = Math.floor(timeDiff / (1000 * 3600 * 24));
  return diffDays;
}

function mapDaysToDateAD(daysPassed) {
  const mappedDate = new Date(Date.UTC(1943, 3, 13 + daysPassed));
  return {
    year: mappedDate.getUTCFullYear(),
    month: mappedDate.getUTCMonth(),
    date: mappedDate.getUTCDate(),
    day: mappedDate.getUTCDay()
  };
}

// Main conversion functions
function convertToAD(bsDateObject) {
  try {
    const daysPassed = findPassedDays(bsDateObject.year, bsDateObject.month, bsDateObject.date);
    const BS = mapDaysToDate(daysPassed);
    const AD = mapDaysToDateAD(daysPassed);

    return {
      AD,
      BS: { ...BS, day: AD.day }
    };
  } catch {
    throw new Error("The date doesn't fall within 2000/01/01 - 2090/12/30");
  }
}

function convertToBS(adDateObject) {
  try {
    const daysPassed = findPassedDaysAD(
      adDateObject.getFullYear(),
      adDateObject.getMonth(),
      adDateObject.getDate()
    );
    const BS = mapDaysToDate(daysPassed);
    const AD = mapDaysToDateAD(daysPassed);

    return {
      AD,
      BS: { ...BS, day: AD.day }
    };
  } catch {
    throw new Error("The date doesn't fall within 2000/01/01 - 2090/12/30");
  }
}

// Formatting functions
function mapLanguageNumber(dateNumber, language) {
  return dateNumber
    .split('')
    .map((num) => formatObj[language].date[parseInt(num, 10)])
    .join('');
}

function format(bsDate, stringFormat, language) {
  return stringFormat
    .replace(/((\\[MDYd])|D{1,2}|M{1,4}|Y{2,4}|d{1,3})/g, (match, _, matchedString) => {
      switch (match) {
        case 'D':
          return mapLanguageNumber(bsDate.date.toString(), language);
        case 'DD':
          return mapLanguageNumber(bsDate.date.toString().padStart(2, '0'), language);
        case 'M':
          return mapLanguageNumber((bsDate.month + 1).toString(), language);
        case 'MM':
          return mapLanguageNumber((bsDate.month + 1).toString().padStart(2, '0'), language);
        case 'MMM':
          return formatObj[language].month.short[bsDate.month];
        case 'MMMM':
          return formatObj[language].month.long[bsDate.month];
        case 'YY':
          return mapLanguageNumber(bsDate.year.toString().slice(-2), language);
        case 'YYY':
          return mapLanguageNumber(bsDate.year.toString().slice(-3), language);
        case 'YYYY':
          return mapLanguageNumber(bsDate.year.toString(), language);
        case 'd':
          return mapLanguageNumber(bsDate.day?.toString() || '0', language);
        case 'dd':
          return formatObj[language].day.short[bsDate.day || 0];
        case 'ddd':
          return formatObj[language].day.long[bsDate.day || 0];
        default:
          return matchedString.replace('/', '');
      }
    })
    .replace(/\\/g, '');
}

// Public API functions
function adToBs(adDateString) {
  try {
    const adDate = new Date(adDateString);
    const result = convertToBS(adDate);
    const bs = result.BS;
    return `${bs.year}-${(bs.month + 1).toString().padStart(2, '0')}-${bs.date.toString().padStart(2, '0')}`;
  } catch (error) {
    console.error('Error converting AD to BS:', error);
    return adDateString; // Return original if conversion fails
  }
}

function bsToAd(bsDateString) {
  try {
    // Parse BS date string (YYYY-MM-DD format)
    const parts = bsDateString.split('-');
    if (parts.length === 3) {
      const year = parseInt(parts[0]);
      const month = parseInt(parts[1]) - 1; // Convert to 0-based month
      const date = parseInt(parts[2]);
      
      const result = convertToAD({ year, month, date });
      const ad = result.AD;
      return `${ad.year}-${(ad.month + 1).toString().padStart(2, '0')}-${ad.date.toString().padStart(2, '0')}`;
    }
    throw new Error('Invalid BS date format');
  } catch (error) {
    console.error('Error converting BS to AD:', error);
    return bsDateString; // Return original if conversion fails
  }
}

// Compatibility wrapper to make nepali-date-converter compatible with nepali-date-picker.js
// nepali-date-picker.js expects 1-based months (1-12), but nepali-date-converter returns 0-based months (0-11)
function convertToBSCompatible(adDateObject) {
  const result = convertToBS(adDateObject);
  return {
    AD: result.AD,
    BS: {
      ...result.BS,
      month: result.BS.month + 1 // Convert 0-based to 1-based month
    }
  };
}

function convertToADCompatible(bsDateObject) {
  // Convert 1-based month to 0-based for internal processing
  const adjustedBsDate = {
    ...bsDateObject,
    month: bsDateObject.month - 1
  };
  return convertToAD(adjustedBsDate);
}

// Export functions for global use
window.NepaliDateConverter = {
  adToBs,
  bsToAd,
  convertToAD,
  convertToBS,
  convertToADCompatible,
  convertToBSCompatible,
  format
};

