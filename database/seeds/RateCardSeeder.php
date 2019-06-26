<?php

use Illuminate\Database\Seeder;
use PAX\Models\RateCard;
use PAX\Models\RateCardZone;

class RateCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setupZones();
        $this->setupRates();
    }

    private function setupZones()
    {
        $countries = countries();

        $zones = [
            'A' => ['BURUNDI', 'KENYA', 'RWANDA', 'TANZANIA', 'UGANDA'],
            'B' => ['EGYPT', 'ETHIOPIA', 'GHANA', 'NIGERIA', 'SOUTH AFRICA'],
            'C' => ['IRELAND', 'UNITED KINGDOM'],
            'D' => [
                'CANADA', 'MEXICO', 'UNITED STATES', 'AFGHANISTAN', 'BAHRAIN', 'BANGLADESH', 'BHUTAN',
                'CYPRUS', 'DJIBOUTI', 'INDIA', 'IRAQ', 'ISRAEL', 'JORDAN', 'KAZAKHISTAN', 'KUWAIT',
                'KYRGYSTAN', 'LEBANON', 'LIBYA', 'MALDIVES', 'NEPAL', 'OMAN', 'PAKISTAN', 'PALESTINE',
                'QATAR', 'SRI LANKA', 'SYRIA', 'UNITED ARAB EMIRATES', 'UZBEKISTAN', 'YEMEN',
            ],
            'E' => [
                'AUSTRIA', 'BELGIUM', 'DENMARK', 'FINLAND', 'GERMANY', 'GREECE', 'GREENLAND', 'ITALY',
                'LEICHTENSTEIN', 'LUXEMBOURG', 'NETHERLANDS', 'NORWAY', 'PORTUGAL', 'SPAIN', 'SWEDEN',
                'SWITZERLAND', 'VATICAN CITY'
            ],
            'F' => [
                'AUSTRALIA', 'CHINA', 'HONG KONG', 'INDONESIA', 'JAPAN', 'LAOS', 'MACAU', 'MALAYSIA',
                'NEW ZEALAND', 'PHILIPPINES', 'SINGAPORE', 'SOUTH KOREA', 'TAIWAN', 'THAILAND', 'VIETNAM',
            ],
            'G' => [
                'ALBANIA', 'ALGERIA', 'ANDORRA', 'ANGOLA', 'ARMENIA', 'AZERBAIJAN', 'BELARUS', 'BENIN',
                'BOSNIA', 'BOTSWANA', 'BULGARIA', 'BURKINA FASO', 'CAMEROON', 'CAPE VERDE', 'CENT AFR REP',
                'CHAD', 'CONGO', 'DRC', 'CROATIA', 'CZECH REPUBLIC', 'ERITREA', 'ESTONIA', 'FRANCE', 'GABON',
                'GAMBIA', 'GEORGIA', 'GIBRALTAR', 'GUINEA', 'GUINEA BISSAU', 'EQUATORIAL GUINEA', 'HUNGARY',
                'ICELAND', 'IVORY COAST', 'LATVIA', 'LESOTHO', 'LIBERIA', 'LITHUANIA', 'MACEDONIA',
                'MADAGASCAR', 'MALAWI', 'MALI', 'MALTA', 'MAURITANIA', 'MAURITIUS', 'MOLDOVA', 'MONACO',
                'MONTENEGRO', 'MOROCCO', 'MOZAMBIQUE', 'NAMIBIA', 'NIGER', 'POLAND', 'REUNION ISLAND', 'ROMANIA',
                'RUSSIA', 'SAUDI ARABIA', 'SENEGAL', 'SERBIA', 'SEYCHELLES', 'SIERRA LEONE', 'SLOVAK REPUBLIC',
                'SLOVENIA', 'SOMALIA', 'SUDAN', 'SWAZILAND', 'TOGO', 'TONGA', 'TUNISIA', 'TURKEY', 'UKRAINE',
                'ZAMBIA', 'ZIMBABWE',
            ],
            'H' => [
                'AMERICAN SAMOA', 'ANGUILLA', 'ANTIGUA', 'ARGENTINA', 'ARUBA', 'BAHAMAS', 'BARBADOS', 'BELIZE',
                'BERMUDA', 'BOLIVIA', 'BRAZIL', 'BRITISH VIRGIN IS.', 'BRUNEI', 'CAMBODIA', 'CAYMAN ISLANDS',
                'CHILE', 'COLOMBIA', 'COOK ISLANDS', 'COSTA RICA', 'DOMINICA', 'DOMINICAN REPUBLIC', 'EAST TIMOR',
                'ECUADOR', 'EL SALVADOR', 'FIJI', 'FRENCH GUIANA', 'FRENCH POLYNESIA', 'GRENADA', 'GUADELOUPE',
                'GUAM', 'GUATEMALA', 'GUYANA', 'HAITI', 'HONDURAS', 'JAMAICA', 'KIRIBATI', 'MARSHALL ISLANDS',
                'MARTINIQUE', 'MICRONESIA', 'MONGOLIA', 'MONTSERRAT', 'MYANMAR', 'NAURU', 'NEW CALEDONIA',
                'NICARAGUA', 'NIUE', 'NL. ANTILLES', 'PALAU', 'PANAMA', 'PAPUA NEW GUINEA', 'PARAGUAY', 'PERU',
                'PUERTO RICO', 'SAIPAN', 'SAMOA', 'SOLOMON ISLANDS', 'ST. Kitts', 'ST. LUCIA', 'ST. VINCENT',
                'SURINAME', 'TRINIDAD & TOBAG', 'TURKS & CAICOS I', 'TUVALU', 'URUGUAY', 'VANUATU', 'VENEZUELA',
                'VIRGIN ISLANDS', 'WALLIS & FUTUNA',
            ],
            'I' => [
                'Bonaire', 'Comoros', 'Cuba', 'Curacao', 'Falkland Island', 'FAROE', 'Guernsey',
                'Iran(Islamic Repubic of)', 'Jersey', 'Korea, The D.P.R of', 'Kosovo', 'Mayotte', 'Nevis',
                'San Marino', 'Sao Tome and Principe', 'Somaliland,Rep of (North Somalia)', 'St. Barthelemy',
                'St. Helena', 'St.Eustatius', 'St.Maarten', 'Tahiti', 'Tajikistan',
            ],
        ];

        $toInsert = [];

        foreach ($zones as $key => $areas) {
            foreach ($areas as $area) {
                $item = ucwords(strtolower($area));

                $code = '';

                if (isset($countries[$item])) {
                    $code = $countries[$item];
                }

                $toInsert[] = [
                    'name' => $item,
                    'zone' => $key,
                    'code' => $code,
                ];
            }
        }

        RateCardZone::insert($toInsert);
    }

    private function setupRates()
    {
        RateCard::insert($this->getEnvelope());
        RateCard::insert($this->getPak());
        RateCard::insert($this->getOthers());
    }

    private function getEnvelope()
    {
        $rates = [
            '0.25' => [
                'zone_a' => 2000,
                'zone_b' => 2800,
                'zone_c' => 2900,
                'zone_d' => 3600,
                'zone_e' => 3700,
                'zone_f' => 3800,
                'zone_g' => 4000,
                'zone_h' => 4800,
                'zone_i' => 6000,
            ],
            '0.50' => [
                'zone_a' => 2400,
                'zone_b' => 3221,
                'zone_c' => 3283,
                'zone_d' => 4380,
                'zone_e' => 4248,
                'zone_f' => 4270,
                'zone_g' => 4416,
                'zone_h' => 5379,
                'zone_i' => 6709,
            ],
        ];

        return $this->mapRates($rates, RateCard::ENVELOPE);
    }

    private function getPak()
    {
        $rates   = [
            '0.50' => [
                'zone_a' => 2415.40,
                'zone_b' => 3235.65,
                'zone_c' => 3298.37,
                'zone_d' => 4395.00,
                'zone_e' => 4263.37,
                'zone_f' => 4270.13,
                'zone_g' => 4415.84,
                'zone_h' => 5378.91,
                'zone_i' => 6723.64,
            ],
            '1.00' => [
                'zone_a' => 3148.80,
                'zone_b' => 4087.74,
                'zone_c' => 4163.98,
                'zone_d' => 5783.00,
                'zone_e' => 5633.67,
                'zone_f' => 5619.20,
                'zone_g' => 5721.49,
                'zone_h' => 6938.35,
                'zone_i' => 8672.94,
            ],
            '1.50' => [
                'zone_a' => 3869.65,
                'zone_b' => 4909.92,
                'zone_c' => 5009.32,
                'zone_d' => 7060.00,
                'zone_e' => 6869.84,
                'zone_f' => 6837.99,
                'zone_g' => 6893.96,
                'zone_h' => 8288.39,
                'zone_i' => 10360.48,
            ],
            '2.00' => [
                'zone_a' => 4590.51,
                'zone_b' => 5732.10,
                'zone_c' => 5854.66,
                'zone_d' => 8344.00,
                'zone_e' => 8106.00,
                'zone_f' => 8056.79,
                'zone_g' => 8066.44,
                'zone_h' => 9638.42,
                'zone_i' => 12048.03,
            ],
        ];

        return $this->mapRates($rates, RateCard::PAK);
    }

    private function getOthers()
    {
        $rates = [
            '0.50' => [
                'zone_a' => 3297.41, 'zone_b' => 4027.91, 'zone_c' => 4027.91, 'zone_d' => 4727.00, 'zone_e' => 5989.76, 'zone_f' => 5864.00, 'zone_g' => '6414.36', 'zone_h' => 7814.57, 'zone_i' => 9768.21
            ],
            '1.00' => [
                'zone_a' => 4361.91, 'zone_b' => 5174.33, 'zone_c' => 4925.36, 'zone_d' => 5939.00, 'zone_e' => 7526.04, 'zone_f' => 7451.00, 'zone_g' => '7739.30', 'zone_h' => 9608.51, 'zone_i' => 12010.63
            ],
            '1.50' => [
                'zone_a' => 5115.89, 'zone_b' => 6060.20, 'zone_c' => 5817.02, 'zone_d' => 7104.00, 'zone_e' => 8799.84, 'zone_f' => 8766.00, 'zone_g' => '8930.11', 'zone_h' => 11158.30, 'zone_i' => 13947.87
            ],
            '2.00' => [
                'zone_a' => 5861.89, 'zone_b' => 6946.07, 'zone_c' => 6714.47, 'zone_d' => 8268.00, 'zone_e' => 10073.64, 'zone_f' => 10081.00, 'zone_g' => 10120.92, 'zone_h' => 12708.09, 'zone_i' => 15885.11
            ],
            '2.50' => [
                'zone_a' => 6607.89, 'zone_b' => 7831.94, 'zone_c' => 7611.92, 'zone_d' => 9433.00, 'zone_e' => 11347.44, 'zone_f' => 11396.00, 'zone_g' => 11311.73, 'zone_h' => 14257.88, 'zone_i' => 17822.34
            ],
            '3.00' => [
                'zone_a' => 7382.84, 'zone_b' => 8701.41, 'zone_c' => 8543.15, 'zone_d' => 10576.00, 'zone_e' => 12589.39, 'zone_f' => 12678.00, 'zone_g' => 12437.89, 'zone_h' => 15672.57, 'zone_i' => 19590.71
            ],
            '3.50' => [
                'zone_a' => 8158.84, 'zone_b' => 9570.87, 'zone_c' => 9474.37, 'zone_d' => 11720.00, 'zone_e' => 13831.35, 'zone_f' => 13960.00, 'zone_g' => 13564.04, 'zone_h' => 17087.26, 'zone_i' => 21359.07
            ],
            '4.00' => [
                'zone_a' => 8934.84, 'zone_b' => 10440.34, 'zone_c' => 10405.60, 'zone_d' => 12863.00, 'zone_e' => 15073.30, 'zone_f' => 15242.00, 'zone_g' => 14690.20, 'zone_h' => 18501.95, 'zone_i' => 23127.43
            ],
            '4.50' => [
                'zone_a' => 9710.84, 'zone_b' => 11309.80, 'zone_c' => 11336.82, 'zone_d' => 14007.00, 'zone_e' => 16315.26, 'zone_f' => 16524.00, 'zone_g' => 15816.35, 'zone_h' => 19916.64, 'zone_i' => 24895.79
            ],
            '5.00' => [
                'zone_a' => 10486.84, 'zone_b' => 12179.27, 'zone_c' => 12268.05, 'zone_d' => 15151.00, 'zone_e' => 17557.21, 'zone_f' => 17806.00, 'zone_g' => 16942.51, 'zone_h' => 21331.33, 'zone_i' => 26664.16
            ],
            '5.50' => [
                'zone_a' => 11150.90, 'zone_b' => 12957.06, 'zone_c' => 13042.94, 'zone_d' => 16150.00, 'zone_e' => 18580.11, 'zone_f' => 18861.00, 'zone_g' => 17901.72, 'zone_h' => 22526.96, 'zone_i' => 28158.70
            ],
            '6.00' => [
                'zone_a' => 11810.90, 'zone_b' => 13734.85, 'zone_c' => 13817.84, 'zone_d' => 17150.00, 'zone_e' => 19603.01, 'zone_f' => 19916.00, 'zone_g' => 18860.93, 'zone_h' => 23722.60, 'zone_i' => 29653.24
            ],
            '6.50' => [
                'zone_a' => 12470.90, 'zone_b' => 14512.64, 'zone_c' => 14592.73, 'zone_d' => 18150.00, 'zone_e' => 20625.91, 'zone_f' => 20971.00, 'zone_g' => 19820.14, 'zone_h' => 24918.23, 'zone_i' => 31147.79
            ],
            '7.00' => [
                'zone_a' => 13130.90, 'zone_b' => 15290.43, 'zone_c' => 15367.63, 'zone_d' => 18563.00, 'zone_e' => 21648.81, 'zone_f' => 22026.00, 'zone_g' => 20779.35, 'zone_h' => 26113.87, 'zone_i' => 32642.33
            ],
            '7.50' => [
                'zone_a' => 13790.90, 'zone_b' => 16068.22, 'zone_c' => 16142.52, 'zone_d' => 19532.00, 'zone_e' => 22671.71, 'zone_f' => 23081.00, 'zone_g' => 21738.56, 'zone_h' => 27309.50, 'zone_i' => 34136.88
            ],
            '8.00' => [
                'zone_a' => 14450.90, 'zone_b' => 16846.01, 'zone_c' => 16917.42, 'zone_d' => 20501.00, 'zone_e' => 23694.61, 'zone_f' => 24136.00, 'zone_g' => 22697.77, 'zone_h' => 28505.14, 'zone_i' => 35631.42
            ],
            '8.50' => [
                'zone_a' => 15110.90, 'zone_b' => 17623.80, 'zone_c' => 17692.31, 'zone_d' => 21470.00, 'zone_e' => 24717.51, 'zone_f' => 25191.00, 'zone_g' => 23656.98, 'zone_h' => 29700.77, 'zone_i' => 37125.96
            ],
            '9.00' => [
                'zone_a' => 15770.90, 'zone_b' => 18401.59, 'zone_c' => 18467.21, 'zone_d' => 22439.00, 'zone_e' => 25740.41, 'zone_f' => 26243.00, 'zone_g' => 24616.19, 'zone_h' => 30896.41, 'zone_i' => 38620.51
            ],
            '9.50' => [
                'zone_a' => 16430.90, 'zone_b' => 19179.38, 'zone_c' => 19242.10, 'zone_d' => 23408.00, 'zone_e' => 26763.31, 'zone_f' => 27295.00, 'zone_g' => 25575.40, 'zone_h' => 32092.04, 'zone_i' => 40115.05
            ],
            '10.00' => [
                'zone_a' => 17090.90, 'zone_b' => 19957.17, 'zone_c' => 20017.00, 'zone_d' => 24377.00, 'zone_e' => 27786.21, 'zone_f' => 28347.00, 'zone_g' => 26534.61, 'zone_h' => 33287.68, 'zone_i' => 41609.59
            ],
            '10.50' => [
                'zone_a' => 17481.67, 'zone_b' => 20378.87, 'zone_c' => 20494.67, 'zone_d' => 25093.00, 'zone_e' => 28514.79, 'zone_f' => 29094.00, 'zone_g' => 27236.16, 'zone_h' => 34182.23, 'zone_i' => 42727.79
            ],
            '11.00' => [
                'zone_a' => 17862.67, 'zone_b' => 20800.58, 'zone_c' => 20972.35, 'zone_d' => 25810.00, 'zone_e' => 29243.36, 'zone_f' => 29841.00, 'zone_g' => 27937.72, 'zone_h' => 35076.79, 'zone_i' => 43845.98
            ],
            '11.50' => [
                'zone_a' => 18243.67, 'zone_b' => 21222.28, 'zone_c' => 21450.02, 'zone_d' => 26526.00, 'zone_e' => 29971.94, 'zone_f' => 30588.00, 'zone_g' => 28639.27, 'zone_h' => 35971.34, 'zone_i' => 44964.18
            ],
            '12.00' => [
                'zone_a' => 18624.67, 'zone_b' => 21643.99, 'zone_c' => 21927.70, 'zone_d' => 27242.00, 'zone_e' => 30700.51, 'zone_f' => 31335.00, 'zone_g' => 29340.83, 'zone_h' => 36865.90, 'zone_i' => 46082.37
            ],
            '12.50' => [
                'zone_a' => 19005.67, 'zone_b' => 22065.69, 'zone_c' => 22405.37, 'zone_d' => 27959.00, 'zone_e' => 31429.09, 'zone_f' => 32082.00, 'zone_g' => 30042.38, 'zone_h' => 37760.45, 'zone_i' => 47200.56
            ],
            '13.00' => [
                'zone_a' => 19386.67, 'zone_b' => 22487.40, 'zone_c' => 22883.05, 'zone_d' => 28675.00, 'zone_e' => 32157.66, 'zone_f' => 32829.00, 'zone_g' => 30743.94, 'zone_h' => 38655.01, 'zone_i' => 48318.76
            ],
            '13.50' => [
                'zone_a' => 19767.67, 'zone_b' => 22909.10, 'zone_c' => 23360.72, 'zone_d' => 29231.00, 'zone_e' => 32886.24, 'zone_f' => 33576.00, 'zone_g' => 31445.49, 'zone_h' => 39549.56, 'zone_i' => 49436.95
            ],
            '14.00' => [
                'zone_a' => 20148.67, 'zone_b' => 23330.81, 'zone_c' => 23838.40, 'zone_d' => 30107.00, 'zone_e' => 33614.81, 'zone_f' => 34323.00, 'zone_g' => 32147.05, 'zone_h' => 40444.12, 'zone_i' => 50555.14
            ],
            '14.50' => [
                'zone_a' => 20529.67, 'zone_b' => 23752.51, 'zone_c' => 24316.07, 'zone_d' => 30824.00, 'zone_e' => 34343.39, 'zone_f' => 35070.00, 'zone_g' => 32848.60, 'zone_h' => 41338.67, 'zone_i' => 51673.34
            ],
            '15.00' => [
                'zone_a' => 20910.67, 'zone_b' => 24174.22, 'zone_c' => 24793.75, 'zone_d' => 31540.00, 'zone_e' => 35071.96, 'zone_f' => 35817.00, 'zone_g' => 33550.16, 'zone_h' => 42233.23, 'zone_i' => 52791.53
            ],
            '15.50' => [
                'zone_a' => 21291.67, 'zone_b' => 24595.92, 'zone_c' => 25271.42, 'zone_d' => 32256.00, 'zone_e' => 35800.54, 'zone_f' => 36564.00, 'zone_g' => 34251.71, 'zone_h' => 43127.78, 'zone_i' => 53909.73
            ],
            '16.00' => [
                'zone_a' => 21672.67, 'zone_b' => 25017.63, 'zone_c' => 25749.10, 'zone_d' => 32973.00, 'zone_e' => 36529.11, 'zone_f' => 37311.00, 'zone_g' => 34953.27, 'zone_h' => 44022.34, 'zone_i' => 55027.92
            ],
            '16.50' => [
                'zone_a' => 22053.67, 'zone_b' => 25439.33, 'zone_c' => 26226.77, 'zone_d' => 33689.00, 'zone_e' => 37257.69, 'zone_f' => 38058.00, 'zone_g' => 35654.82, 'zone_h' => 44916.89, 'zone_i' => 56146.11
            ],
            '17.00' => [
                'zone_a' => 22434.67, 'zone_b' => 25861.04, 'zone_c' => 26704.45, 'zone_d' => 34405.00, 'zone_e' => 37986.26, 'zone_f' => 38805.00, 'zone_g' => 36356.38, 'zone_h' => 45811.45, 'zone_i' => 57264.31
            ],
            '17.50' => [
                'zone_a' => 22815.67, 'zone_b' => 26282.74, 'zone_c' => 27182.12, 'zone_d' => 35122.00, 'zone_e' => 38714.84, 'zone_f' => 39552.00, 'zone_g' => 37057.93, 'zone_h' => 46706.00, 'zone_i' => 58382.50
            ],
            '18.00' => [
                'zone_a' => 23196.67, 'zone_b' => 26704.45, 'zone_c' => 27659.80, 'zone_d' => 35838.00, 'zone_e' => 39443.41, 'zone_f' => 40299.00, 'zone_g' => 37759.49, 'zone_h' => 47600.56, 'zone_i' => 59500.69
            ],
            '18.50' => [
                'zone_a' => 23577.67, 'zone_b' => 27126.15, 'zone_c' => 28137.47, 'zone_d' => 36554.00, 'zone_e' => 40171.99, 'zone_f' => 41046.00, 'zone_g' => 38461.04, 'zone_h' => 48495.11, 'zone_i' => 60618.89
            ],
            '19.00' => [
                'zone_a' => 23958.67, 'zone_b' => 27547.86, 'zone_c' => 28615.15, 'zone_d' => 37270.00, 'zone_e' => 40900.56, 'zone_f' => 41793.00, 'zone_g' => 39162.60, 'zone_h' => 49389.67, 'zone_i' => 61737.08
            ],
            '19.50' => [
                'zone_a' => 24339.67, 'zone_b' => 27969.56, 'zone_c' => 29092.82, 'zone_d' => 38586.00, 'zone_e' => 41629.14, 'zone_f' => 42540.00, 'zone_g' => 39864.15, 'zone_h' => 50284.22, 'zone_i' => 62855.28
            ],
            '20.00' => [
                'zone_a' => 24720.67, 'zone_b' => 28391.27, 'zone_c' => 29570.50, 'zone_d' => 39314.00, 'zone_e' => 42357.71, 'zone_f' => 43287.00, 'zone_g' => 40565.71, 'zone_h' => 51178.78, 'zone_i' => 63973.47
            ],
            '20.50' => [
                'zone_a' => 25043.77, 'zone_b' => 28784.99, 'zone_c' => 30003.78, 'zone_d' => 39952.00, 'zone_e' => 43021.63, 'zone_f' => 43967.00, 'zone_g' => 41197.78, 'zone_h' => 52016.40, 'zone_i' => 65020.49
            ],
            '21.00' => [
                'zone_a' => 25364.77, 'zone_b' => 29178.71, 'zone_c' => 30437.07, 'zone_d' => 40590.00, 'zone_e' => 43685.55, 'zone_f' => 44647.00, 'zone_g' => 41829.86, 'zone_h' => 52854.02, 'zone_i' => 66067.52
            ],
            '21.50' => [
                'zone_a' => 25685.77, 'zone_b' => 29572.43, 'zone_c' => 30870.35, 'zone_d' => 41228.00, 'zone_e' => 44349.47, 'zone_f' => 45327.00, 'zone_g' => 42461.93, 'zone_h' => 53691.64, 'zone_i' => 67114.54
            ],
            '22.00' => [
                'zone_a' => 26006.77, 'zone_b' => 29966.15, 'zone_c' => 31303.64, 'zone_d' => 41866.00, 'zone_e' => 45013.39, 'zone_f' => 46007.00, 'zone_g' => 43094.01, 'zone_h' => 54529.26, 'zone_i' => 68161.57
            ],
            '22.50' => [
                'zone_a' => 26327.77, 'zone_b' => 30359.87, 'zone_c' => 31736.92, 'zone_d' => 42503.00, 'zone_e' => 45677.31, 'zone_f' => 46687.00, 'zone_g' => 43726.08, 'zone_h' => 55366.88, 'zone_i' => 69208.59
            ],
            '23.00' => [
                'zone_a' => 26648.77, 'zone_b' => 30753.59, 'zone_c' => 32170.21, 'zone_d' => 43141.00, 'zone_e' => 46341.23, 'zone_f' => 47367.00, 'zone_g' => 44358.16, 'zone_h' => 56204.50, 'zone_i' => 70255.62
            ],
            '23.50' => [
                'zone_a' => 26969.77, 'zone_b' => 31147.31, 'zone_c' => 32603.49, 'zone_d' => 43779.00, 'zone_e' => 47005.15, 'zone_f' => 48047.00, 'zone_g' => 44990.23, 'zone_h' => 57042.12, 'zone_i' => 71302.64
            ],
            '24.00' => [
                'zone_a' => 27290.77, 'zone_b' => 31541.03, 'zone_c' => 33036.78, 'zone_d' => 44417.00, 'zone_e' => 47669.07, 'zone_f' => 48727.00, 'zone_g' => 45622.31, 'zone_h' => 57879.74, 'zone_i' => 72349.67
            ],
            '24.50' => [
                'zone_a' => 27611.77, 'zone_b' => 31934.75, 'zone_c' => 33470.06, 'zone_d' => 45055.00, 'zone_e' => 48332.99, 'zone_f' => 49407.00, 'zone_g' => 46254.38, 'zone_h' => 58717.36, 'zone_i' => 73396.69
            ],
            '25.00' => [
                'zone_a' => 27932.77, 'zone_b' => 32328.47, 'zone_c' => 33903.35, 'zone_d' => 46593.00, 'zone_e' => 48996.91, 'zone_f' => 50087.00, 'zone_g' => 46886.46, 'zone_h' => 59554.98, 'zone_i' => 74443.72
            ],
            '25.50' => [
                'zone_a' => 28253.77, 'zone_b' => 32722.19, 'zone_c' => 34336.63, 'zone_d' => 46331.00, 'zone_e' => 49660.83, 'zone_f' => 50767.00, 'zone_g' => 47518.53, 'zone_h' => 60392.60, 'zone_i' => 75490.74
            ],
            '26.00' => [
                'zone_a' => 28574.77, 'zone_b' => 33115.91, 'zone_c' => 34769.92, 'zone_d' => 46998.00, 'zone_e' => 50324.75, 'zone_f' => 51447.00, 'zone_g' => 48150.61, 'zone_h' => 61230.22, 'zone_i' => 76537.77
            ],
            '26.50' => [
                'zone_a' => 28895.77, 'zone_b' => 33509.63, 'zone_c' => 35203.20, 'zone_d' => 47606.00, 'zone_e' => 50988.67, 'zone_f' => 52127.00, 'zone_g' => 48782.68, 'zone_h' => 62067.84, 'zone_i' => 77584.79
            ],
            '27.00' => [
                'zone_a' => 29216.77, 'zone_b' => 33903.35, 'zone_c' => 35636.49, 'zone_d' => 48244.00, 'zone_e' => 51652.59, 'zone_f' => 52807.00, 'zone_g' => 49414.76, 'zone_h' => 62905.46, 'zone_i' => 78631.82
            ],
            '27.50' => [
                'zone_a' => 29537.77, 'zone_b' => 34297.07, 'zone_c' => 36069.77, 'zone_d' => 48882.00, 'zone_e' => 52316.51, 'zone_f' => 53487.00, 'zone_g' => 50046.83, 'zone_h' => 63743.08, 'zone_i' => 79678.84
            ],
            '28.00' => [
                'zone_a' => 29858.77, 'zone_b' => 34690.79, 'zone_c' => 36503.06, 'zone_d' => 49520.00, 'zone_e' => 52980.43, 'zone_f' => 54167.00, 'zone_g' => 50678.91, 'zone_h' => 64580.70, 'zone_i' => 80725.87
            ],
            '28.50' => [
                'zone_a' => 30179.77, 'zone_b' => 35084.51, 'zone_c' => 36936.34, 'zone_d' => 50158.00, 'zone_e' => 53644.35, 'zone_f' => 54847.00, 'zone_g' => 51310.98, 'zone_h' => 65418.32, 'zone_i' => 81772.89
            ],
            '29.00' => [
                'zone_a' => 30500.77, 'zone_b' => 35478.23, 'zone_c' => 37369.63, 'zone_d' => 50796.00, 'zone_e' => 54308.27, 'zone_f' => 55527.00, 'zone_g' => 51943.06, 'zone_h' => 66255.94, 'zone_i' => 82819.92
            ],
            '29.50' => [
                'zone_a' => 30821.77, 'zone_b' => 35871.95, 'zone_c' => 37802.91, 'zone_d' => 51434.00, 'zone_e' => 54972.19, 'zone_f' => 56207.00, 'zone_g' => 52575.13, 'zone_h' => 67093.56, 'zone_i' => 83866.94
            ],
            '30.00' => [
                'zone_a' => 31142.77, 'zone_b' => 36265.67, 'zone_c' => 38236.20, 'zone_d' => 52071.00, 'zone_e' => 55636.11, 'zone_f' => 56887.00, 'zone_g' => 53207.21, 'zone_h' => 67931.18, 'zone_i' => 84913.97
            ],
            '30.50' => [
                'zone_a' => 31389.46, 'zone_b' => 36649.74, 'zone_c' => 38662.73, 'zone_d' => 52670.00, 'zone_e' => 56268.19, 'zone_f' => 57534.00, 'zone_g' => 53806.47, 'zone_h' => 68735.99, 'zone_i' => 85919.98
            ],
            '31.00' => [
                'zone_a' => 31633.46, 'zone_b' => 37033.81, 'zone_c' => 39089.26, 'zone_d' => 53328.00, 'zone_e' => 56900.26, 'zone_f' => 58181.00, 'zone_g' => 54405.74, 'zone_h' => 69540.80, 'zone_i' => 86925.99
            ],
            '31.50' => [
                'zone_a' => 31877.46, 'zone_b' => 37417.88, 'zone_c' => 39515.79, 'zone_d' => 53956.00, 'zone_e' => 57532.34, 'zone_f' => 58828.00, 'zone_g' => 55005.00, 'zone_h' => 70345.61, 'zone_i' => 87932.01
            ],
            '32.00' => [
                'zone_a' => 32121.46, 'zone_b' => 37801.95, 'zone_c' => 39942.32, 'zone_d' => 53736.00, 'zone_e' => 58164.41, 'zone_f' => 59475.00, 'zone_g' => 55604.27, 'zone_h' => 71150.42, 'zone_i' => 88938.02
            ],
            '32.50' => [
                'zone_a' => 32365.46, 'zone_b' => 38186.02, 'zone_c' => 40368.85, 'zone_d' => 54354.00, 'zone_e' => 58796.49, 'zone_f' => 60122.00, 'zone_g' => 56203.53, 'zone_h' => 71955.23, 'zone_i' => 89944.03
            ],
            '33.00' => [
                'zone_a' => 32609.46, 'zone_b' => 38570.09, 'zone_c' => 40795.38, 'zone_d' => 54973.00, 'zone_e' => 59428.56, 'zone_f' => 60769.00, 'zone_g' => 56802.80, 'zone_h' => 72760.04, 'zone_i' => 90950.04
            ],
            '33.50' => [
                'zone_a' => 32853.46, 'zone_b' => 38954.16, 'zone_c' => 41221.91, 'zone_d' => 55591.00, 'zone_e' => 60060.64, 'zone_f' => 61416.00, 'zone_g' => 57402.06, 'zone_h' => 73564.85, 'zone_i' => 91956.06
            ],
            '34.00' => [
                'zone_a' => 33097.46, 'zone_b' => 39338.23, 'zone_c' => 41648.44, 'zone_d' => 56210.00, 'zone_e' => 60692.71, 'zone_f' => 62063.00, 'zone_g' => 58001.33, 'zone_h' => 74369.66, 'zone_i' => 92962.07
            ],
            '34.50' => [
                'zone_a' => 33341.46, 'zone_b' => 39722.30, 'zone_c' => 42074.97, 'zone_d' => 56828.00, 'zone_e' => 61324.79, 'zone_f' => 62707.00, 'zone_g' => 58600.59, 'zone_h' => 75174.47, 'zone_i' => 93968.08
            ],
            '35.00' => [
                'zone_a' => 33585.46, 'zone_b' => 40106.37, 'zone_c' => 42501.50, 'zone_d' => 57447.00, 'zone_e' => 61956.86, 'zone_f' => 63351.00, 'zone_g' => 59199.86, 'zone_h' => 75979.28, 'zone_i' => 94974.09
            ],
            '35.50' => [
                'zone_a' => 33829.46, 'zone_b' => 40490.44, 'zone_c' => 42928.03, 'zone_d' => 58065.00, 'zone_e' => 62588.94, 'zone_f' => 63995.00, 'zone_g' => 59799.12, 'zone_h' => 76784.09, 'zone_i' => 95980.11
            ],
            '36.00' => [
                'zone_a' => 34073.46, 'zone_b' => 40874.51, 'zone_c' => 43354.56, 'zone_d' => 58683.00, 'zone_e' => 63221.01, 'zone_f' => 64639.00, 'zone_g' => 60398.39, 'zone_h' => 77588.90, 'zone_i' => 96986.12
            ],
            '36.50' => [
                'zone_a' => 34317.46, 'zone_b' => 41258.58, 'zone_c' => 43781.09, 'zone_d' => 59302.00, 'zone_e' => 63853.09, 'zone_f' => 65283.00, 'zone_g' => 60997.65, 'zone_h' => 78393.71, 'zone_i' => 97992.13
            ],
            '37.00' => [
                'zone_a' => 34561.46, 'zone_b' => 41642.65, 'zone_c' => 44207.62, 'zone_d' => 59920.00, 'zone_e' => 64485.16, 'zone_f' => 65927.00, 'zone_g' => 61596.92, 'zone_h' => 79198.52, 'zone_i' => 98998.14
            ],
            '37.50' => [
                'zone_a' => 34805.46, 'zone_b' => 42026.72, 'zone_c' => 44634.15, 'zone_d' => 60539.00, 'zone_e' => 65117.24, 'zone_f' => 66571.00, 'zone_g' => 62196.18, 'zone_h' => 80003.33, 'zone_i' => 100004.16
            ],
            '38.00' => [
                'zone_a' => 35049.46, 'zone_b' => 42410.79, 'zone_c' => 45060.68, 'zone_d' => 61157.00, 'zone_e' => 65749.31, 'zone_f' => 67215.00, 'zone_g' => 62795.45, 'zone_h' => 80808.14, 'zone_i' => 101010.17
            ],
            '38.50' => [
                'zone_a' => 35293.46, 'zone_b' => 42794.86, 'zone_c' => 45487.21, 'zone_d' => 61776.00, 'zone_e' => 66381.39, 'zone_f' => 67859.00, 'zone_g' => 63394.71, 'zone_h' => 81612.95, 'zone_i' => 102016.18
            ],
            '39.00' => [
                'zone_a' => 35537.46, 'zone_b' => 43178.93, 'zone_c' => 45913.74, 'zone_d' => 62394.00, 'zone_e' => 67013.46, 'zone_f' => 68503.00, 'zone_g' => 63993.98, 'zone_h' => 82417.76, 'zone_i' => 103022.19
            ],
            '39.50' => [
                'zone_a' => 35781.46, 'zone_b' => 43563.00, 'zone_c' => 46340.27, 'zone_d' => 63013.00, 'zone_e' => 67645.54, 'zone_f' => 69147.00, 'zone_g' => 64593.24, 'zone_h' => 83222.57, 'zone_i' => 104028.21
            ],
            '40.00' => [
                'zone_a' => 36025.46, 'zone_b' => 43947.07, 'zone_c' => 46766.80, 'zone_d' => 63631.00, 'zone_e' => 68277.61, 'zone_f' => 69791.00, 'zone_g' => 65192.51, 'zone_h' => 84027.38, 'zone_i' => 105034.22
            ],
            '40.50' => [
                'zone_a' => 36269.46, 'zone_b' => 44331.14, 'zone_c' => 47193.33, 'zone_d' => 64249.00, 'zone_e' => 68909.69, 'zone_f' => 70435.00, 'zone_g' => 65791.77, 'zone_h' => 84832.19, 'zone_i' => 106040.23
            ],
            '41.00' => [
                'zone_a' => 36513.46, 'zone_b' => 44715.21, 'zone_c' => 47619.86, 'zone_d' => 64868.00, 'zone_e' => 69541.76, 'zone_f' => 71079.00, 'zone_g' => 66391.04, 'zone_h' => 85637.00, 'zone_i' => 107046.24
            ],
            '41.50' => [
                'zone_a' => 36757.46, 'zone_b' => 45099.28, 'zone_c' => 48046.39, 'zone_d' => 65486.00, 'zone_e' => 70173.84, 'zone_f' => 71723.00, 'zone_g' => 66990.30, 'zone_h' => 86441.81, 'zone_i' => 108052.26
            ],
            '42.00' => [
                'zone_a' => 37001.46, 'zone_b' => 45483.35, 'zone_c' => 48472.92, 'zone_d' => 66105.00, 'zone_e' => 70805.91, 'zone_f' => 72367.00, 'zone_g' => 67589.57, 'zone_h' => 87246.62, 'zone_i' => 109058.27
            ],
            '42.50' => [
                'zone_a' => 37245.46, 'zone_b' => 45867.42, 'zone_c' => 48899.45, 'zone_d' => 66723.00, 'zone_e' => 71437.99, 'zone_f' => 73011.00, 'zone_g' => 68188.83, 'zone_h' => 88051.43, 'zone_i' => 110064.28
            ],
            '43.00' => [
                'zone_a' => 37489.46, 'zone_b' => 46251.49, 'zone_c' => 49325.98, 'zone_d' => 67342.00, 'zone_e' => 72070.06, 'zone_f' => 73655.00, 'zone_g' => 68788.10, 'zone_h' => 88856.24, 'zone_i' => 111070.29
            ],
            '43.50' => [
                'zone_a' => 37733.46, 'zone_b' => 46635.56, 'zone_c' => 49752.51, 'zone_d' => 67960.00, 'zone_e' => 72702.14, 'zone_f' => 74299.00, 'zone_g' => 69387.36, 'zone_h' => 89661.05, 'zone_i' => 112076.31
            ],
            '44.00' => [
                'zone_a' => 37977.46, 'zone_b' => 47019.63, 'zone_c' => 50179.04, 'zone_d' => 68579.00, 'zone_e' => 73334.21, 'zone_f' => 74943.00, 'zone_g' => 69986.63, 'zone_h' => 90465.86, 'zone_i' => 113082.32
            ],
            '44.50' => [
                'zone_a' => 38221.46, 'zone_b' => 47403.70, 'zone_c' => 50605.57, 'zone_d' => 71382.00, 'zone_e' => 73966.29, 'zone_f' => 75587.00, 'zone_g' => 70585.89, 'zone_h' => 91270.67, 'zone_i' => 114088.33
            ],
            '45.00' => [
                'zone_a' => 38465.46, 'zone_b' => 47787.77, 'zone_c' => 51032.10, 'zone_d' => 72020.00, 'zone_e' => 74598.36, 'zone_f' => 76231.00, 'zone_g' => 71185.16, 'zone_h' => 92075.48, 'zone_i' => 115094.34
            ],
            '45.50' => [
                'zone_a' => 38709.46, 'zone_b' => 48171.84, 'zone_c' => 51458.63, 'zone_d' => 72658.00, 'zone_e' => 75230.44, 'zone_f' => 76875.00, 'zone_g' => 71784.42, 'zone_h' => 92880.29, 'zone_i' => 116100.36
            ],
            '46.00' => [
                'zone_a' => 38953.46, 'zone_b' => 48555.91, 'zone_c' => 51885.16, 'zone_d' => 73296.00, 'zone_e' => 75862.51, 'zone_f' => 77519.00, 'zone_g' => 72383.69, 'zone_h' => 93685.10, 'zone_i' => 117106.37
            ],
            '46.50' => [
                'zone_a' => 39197.46, 'zone_b' => 48939.98, 'zone_c' => 52311.69, 'zone_d' => 73934.00, 'zone_e' => 76494.59, 'zone_f' => 78163.00, 'zone_g' => 72982.95, 'zone_h' => 94489.91, 'zone_i' => 118112.38
            ],
            '47.00' => [
                'zone_a' => 39441.46, 'zone_b' => 49324.05, 'zone_c' => 52738.22, 'zone_d' => 74572.00, 'zone_e' => 77126.66, 'zone_f' => 78807.00, 'zone_g' => 73582.22, 'zone_h' => 95294.72, 'zone_i' => 119118.39
            ],
            '47.50' => [
                'zone_a' => 39685.46, 'zone_b' => 49708.12, 'zone_c' => 53164.75, 'zone_d' => 75210.00, 'zone_e' => 77758.74, 'zone_f' => 79447.00, 'zone_g' => 74181.48, 'zone_h' => 96099.53, 'zone_i' => 120124.41
            ],
            '48.00' => [
                'zone_a' => 39929.46, 'zone_b' => 50092.19, 'zone_c' => 53591.28, 'zone_d' => 75848.00, 'zone_e' => 78390.81, 'zone_f' => 80087.00, 'zone_g' => 74780.75, 'zone_h' => 96904.34, 'zone_i' => 121130.42
            ],
            '48.50' => [
                'zone_a' => 40173.46, 'zone_b' => 50476.26, 'zone_c' => 54017.81, 'zone_d' => 76486.00, 'zone_e' => 79022.89, 'zone_f' => 80727.00, 'zone_g' => 75380.01, 'zone_h' => 97709.15, 'zone_i' => 122136.43
            ],
            '49.00' => [
                'zone_a' => 40417.46, 'zone_b' => 50860.33, 'zone_c' => 54444.34, 'zone_d' => 77124.00, 'zone_e' => 79654.96, 'zone_f' => 81367.00, 'zone_g' => 75979.28, 'zone_h' => 98513.96, 'zone_i' => 123142.44
            ],
            '49.50' => [
                'zone_a' => 40661.46, 'zone_b' => 51244.40, 'zone_c' => 54870.87, 'zone_d' => 77762.00, 'zone_e' => 80287.04, 'zone_f' => 82007.00, 'zone_g' => 76578.54, 'zone_h' => 99318.77, 'zone_i' => 124148.46
            ],
            '50.00' => [
                'zone_a' => 40905.46, 'zone_b' => 51628.47, 'zone_c' => 55297.40, 'zone_d' => 78400.00, 'zone_e' => 80919.11, 'zone_f' => 82647.00, 'zone_g' => 77177.81, 'zone_h' => 100123.58, 'zone_i' => 125154.47
            ],
            '50.50' => [
                'zone_a' => 41149.46, 'zone_b' => 52012.54, 'zone_c' => 55723.93, 'zone_d' => 79038.00, 'zone_e' => 81551.19, 'zone_f' => 83287.00, 'zone_g' => 77777.07, 'zone_h' => 100928.39, 'zone_i' => 126160.48
            ],
            '51.00' => [
                'zone_a' => 41393.46, 'zone_b' => 52396.61, 'zone_c' => 56150.46, 'zone_d' => 79676.00, 'zone_e' => 82183.26, 'zone_f' => 83927.00, 'zone_g' => 78376.34, 'zone_h' => 101733.20, 'zone_i' => 127166.49
            ],
            '51.50' => [
                'zone_a' => 41637.46, 'zone_b' => 52780.68, 'zone_c' => 56576.99, 'zone_d' => 80314.00, 'zone_e' => 82815.34, 'zone_f' => 84567.00, 'zone_g' => 78975.60, 'zone_h' => 102538.01, 'zone_i' => 128172.51
            ],
            '52.00' => [
                'zone_a' => 41881.46, 'zone_b' => 53164.75, 'zone_c' => 57003.52, 'zone_d' => 80952.00, 'zone_e' => 83447.41, 'zone_f' => 85207.00, 'zone_g' => 79574.87, 'zone_h' => 103342.82, 'zone_i' => 129178.52
            ],
            '52.50' => [
                'zone_a' => 42125.46, 'zone_b' => 53548.82, 'zone_c' => 57430.05, 'zone_d' => 81590.00, 'zone_e' => 84079.49, 'zone_f' => 85847.00, 'zone_g' => 80174.13, 'zone_h' => 104147.63, 'zone_i' => 130184.53
            ],
            '53.00' => [
                'zone_a' => 42369.46, 'zone_b' => 53932.89, 'zone_c' => 57856.58, 'zone_d' => 82228.00, 'zone_e' => 84711.56, 'zone_f' => 86487.00, 'zone_g' => 80773.40, 'zone_h' => 104952.44, 'zone_i' => 131190.54
            ],
            '53.50' => [
                'zone_a' => 42613.46, 'zone_b' => 54316.96, 'zone_c' => 58283.11, 'zone_d' => 82866.00, 'zone_e' => 85343.64, 'zone_f' => 87127.00, 'zone_g' => 81372.66, 'zone_h' => 105757.25, 'zone_i' => 132196.56
            ],
            '54.00' => [
                'zone_a' => 42857.46, 'zone_b' => 54701.03, 'zone_c' => 58709.64, 'zone_d' => 83504.00, 'zone_e' => 85975.71, 'zone_f' => 87767.00, 'zone_g' => 81971.93, 'zone_h' => 106562.06, 'zone_i' => 133202.57
            ],
            '54.50' => [
                'zone_a' => 43101.46, 'zone_b' => 55085.10, 'zone_c' => 59136.17, 'zone_d' => 84124.00, 'zone_e' => 86607.79, 'zone_f' => 88407.00, 'zone_g' => 82571.19, 'zone_h' => 107366.87, 'zone_i' => 134208.58
            ],
            '55.00' => [
                'zone_a' => 43345.46, 'zone_b' => 55469.17, 'zone_c' => 59562.70, 'zone_d' => 84780.00, 'zone_e' => 87239.86, 'zone_f' => 89047.00, 'zone_g' => 83170.46, 'zone_h' => 108171.68, 'zone_i' => 135214.59
            ],
            '55.50' => [
                'zone_a' => 43589.46, 'zone_b' => 55853.24, 'zone_c' => 59989.23, 'zone_d' => 85418.00, 'zone_e' => 87871.94, 'zone_f' => 89687.00, 'zone_g' => 83769.72, 'zone_h' => 108976.49, 'zone_i' => 136220.61
            ],
            '56.00' => [
                'zone_a' => 43833.46, 'zone_b' => 56237.31, 'zone_c' => 60415.76, 'zone_d' => 86056.00, 'zone_e' => 88504.01, 'zone_f' => 90327.00, 'zone_g' => 84368.99, 'zone_h' => 109781.30, 'zone_i' => 137226.62
            ],
            '56.50' => [
                'zone_a' => 44077.46, 'zone_b' => 56621.38, 'zone_c' => 60842.29, 'zone_d' => 86694.00, 'zone_e' => 89136.09, 'zone_f' => 90967.00, 'zone_g' => 84968.25, 'zone_h' => 110586.11, 'zone_i' => 138232.63
            ],
            '57.00' => [
                'zone_a' => 44321.46, 'zone_b' => 57005.45, 'zone_c' => 61268.82, 'zone_d' => 87332.00, 'zone_e' => 89768.16, 'zone_f' => 91607.00, 'zone_g' => 85567.52, 'zone_h' => 111390.92, 'zone_i' => 139238.64
            ],
            '57.50' => [
                'zone_a' => 44565.46, 'zone_b' => 57389.52, 'zone_c' => 61695.35, 'zone_d' => 87970.00, 'zone_e' => 90400.24, 'zone_f' => 92247.00, 'zone_g' => 86166.78, 'zone_h' => 112195.73, 'zone_i' => 140244.66
            ],
            '58.00' => [
                'zone_a' => 44809.46, 'zone_b' => 57773.59, 'zone_c' => 62121.88, 'zone_d' => 88608.00, 'zone_e' => 91032.31, 'zone_f' => 92887.00, 'zone_g' => 86766.05, 'zone_h' => 113000.54, 'zone_i' => 141250.67
            ],
            '58.50' => [
                'zone_a' => 45053.46, 'zone_b' => 58157.66, 'zone_c' => 62548.41, 'zone_d' => 89246.00, 'zone_e' => 91664.39, 'zone_f' => 93527.00, 'zone_g' => 87365.31, 'zone_h' => 113805.35, 'zone_i' => 142256.68
            ],
            '59.00' => [
                'zone_a' => 45297.46, 'zone_b' => 58541.73, 'zone_c' => 62974.94, 'zone_d' => 89884.00, 'zone_e' => 92296.46, 'zone_f' => 94167.00, 'zone_g' => 87964.58, 'zone_h' => 114610.16, 'zone_i' => 143262.69
            ],
            '59.50' => [
                'zone_a' => 45541.46, 'zone_b' => 58925.80, 'zone_c' => 63401.47, 'zone_d' => 90522.00, 'zone_e' => 92928.54, 'zone_f' => 94807.00, 'zone_g' => 88563.84, 'zone_h' => 115414.97, 'zone_i' => 144268.71
            ],
            '60.00' => [
                'zone_a' => 45785.46, 'zone_b' => 59309.87, 'zone_c' => 63828.00, 'zone_d' => 91160.00, 'zone_e' => 93560.61, 'zone_f' => 95447.00, 'zone_g' => 89163.11, 'zone_h' => 116219.78, 'zone_i' => 145274.72
            ],
            '60.50' => [
                'zone_a' => 46029.46, 'zone_b' => 59693.94, 'zone_c' => 64254.53, 'zone_d' => 91798.00, 'zone_e' => 94192.69, 'zone_f' => 96087.00, 'zone_g' => 89762.37, 'zone_h' => 117024.59, 'zone_i' => 146280.73
            ],
            '61.00' => [
                'zone_a' => 46273.46, 'zone_b' => 60078.01, 'zone_c' => 64681.06, 'zone_d' => 92436.00, 'zone_e' => 94824.76, 'zone_f' => 96727.00, 'zone_g' => 90361.64, 'zone_h' => 117829.40, 'zone_i' => 147286.74
            ],
            '61.50' => [
                'zone_a' => 46517.46, 'zone_b' => 60462.08, 'zone_c' => 65107.59, 'zone_d' => 93074.00, 'zone_e' => 95456.84, 'zone_f' => 97367.00, 'zone_g' => 90960.90, 'zone_h' => 118634.21, 'zone_i' => 148292.76
            ],
            '62.00' => [
                'zone_a' => 46761.46, 'zone_b' => 60846.15, 'zone_c' => 65534.12, 'zone_d' => 93712.00, 'zone_e' => 96088.91, 'zone_f' => 98007.00, 'zone_g' => 91560.17, 'zone_h' => 119439.02, 'zone_i' => 149298.77
            ],
            '62.50' => [
                'zone_a' => 47005.46, 'zone_b' => 61230.22, 'zone_c' => 65960.65, 'zone_d' => 94350.00, 'zone_e' => 96720.99, 'zone_f' => 98647.00, 'zone_g' => 92159.43, 'zone_h' => 120243.83, 'zone_i' => 150304.78
            ],
            '63.00' => [
                'zone_a' => 47249.46, 'zone_b' => 61614.29, 'zone_c' => 66387.18, 'zone_d' => 94987.00, 'zone_e' => 97353.06, 'zone_f' => 99287.00, 'zone_g' => 92758.70, 'zone_h' => 121048.64, 'zone_i' => 151310.79
            ],
            '63.50' => [
                'zone_a' => 47493.46, 'zone_b' => 61998.36, 'zone_c' => 66813.71, 'zone_d' => 95625.00, 'zone_e' => 97985.14, 'zone_f' => 99927.00, 'zone_g' => 93357.96, 'zone_h' => 121853.45, 'zone_i' => 152316.81
            ],
            '64.00' => [
                'zone_a' => 47737.46, 'zone_b' => 62382.43, 'zone_c' => 67240.24, 'zone_d' => 96263.00, 'zone_e' => 98617.21, 'zone_f' => 100567.00, 'zone_g' => 93957.23, 'zone_h' => 122658.26, 'zone_i' => 153322.82
            ],
            '64.50' => [
                'zone_a' => 47981.46, 'zone_b' => 62766.50, 'zone_c' => 67666.77, 'zone_d' => 96901.00, 'zone_e' => 99249.29, 'zone_f' => 101207.00, 'zone_g' => 94556.49, 'zone_h' => 123463.07, 'zone_i' => 154328.83
            ],
            '65.00' => [
                'zone_a' => 48225.46, 'zone_b' => 63150.57, 'zone_c' => 68093.30, 'zone_d' => 97539.00, 'zone_e' => 99881.36, 'zone_f' => 101847.00, 'zone_g' => 95155.76, 'zone_h' => 124267.88, 'zone_i' => 155334.84
            ],
            '65.50' => [
                'zone_a' => 48469.46, 'zone_b' => 63534.64, 'zone_c' => 68519.83, 'zone_d' => 98177.00, 'zone_e' => 100513.44, 'zone_f' => 102487.00, 'zone_g' => 95755.02, 'zone_h' => 125072.69, 'zone_i' => 156340.86
            ],
            '66.00' => [
                'zone_a' => 48713.46, 'zone_b' => 63918.71, 'zone_c' => 68946.36, 'zone_d' => 98815.00, 'zone_e' => 101145.51, 'zone_f' => 103127.00, 'zone_g' => 96354.29, 'zone_h' => 125877.50, 'zone_i' => 157346.87
            ],
            '66.50' => [
                'zone_a' => 48957.46, 'zone_b' => 64302.78, 'zone_c' => 69372.89, 'zone_d' => 99453.00, 'zone_e' => 101777.59, 'zone_f' => 103767.00, 'zone_g' => 96953.55, 'zone_h' => 126682.31, 'zone_i' => 158352.88
            ],
            '67.00' => [
                'zone_a' => 49201.46, 'zone_b' => 64686.85, 'zone_c' => 69799.42, 'zone_d' => 100091.00, 'zone_e' => 102409.66, 'zone_f' => 104407.00, 'zone_g' => 97552.82, 'zone_h' => 127487.12, 'zone_i' => 159358.89
            ],
            '67.50' => [
                'zone_a' => 49445.46, 'zone_b' => 65070.92, 'zone_c' => 70225.95, 'zone_d' => 100729.00, 'zone_e' => 103041.74, 'zone_f' => 105047.00, 'zone_g' => 98152.08, 'zone_h' => 128291.93, 'zone_i' => 160364.91
            ],
            '68.00' => [
                'zone_a' => 49689.46, 'zone_b' => 65454.99, 'zone_c' => 70652.48, 'zone_d' => 101367.00, 'zone_e' => 103673.81, 'zone_f' => 105687.00, 'zone_g' => 98751.35, 'zone_h' => 129096.74, 'zone_i' => 161370.92
            ],
            '68.50' => [
                'zone_a' => 49933.46, 'zone_b' => 65839.06, 'zone_c' => 71079.01, 'zone_d' => 102005.00, 'zone_e' => 104305.89, 'zone_f' => 106327.00, 'zone_g' => 99350.61, 'zone_h' => 129901.55, 'zone_i' => 162376.93
            ],
            '69.00' => [
                'zone_a' => 50177.46, 'zone_b' => 66223.13, 'zone_c' => 71505.54, 'zone_d' => 102643.00, 'zone_e' => 104937.96, 'zone_f' => 106967.00, 'zone_g' => 99949.88, 'zone_h' => 130706.36, 'zone_i' => 163382.94
            ],
            '69.50' => [
                'zone_a' => 50421.46, 'zone_b' => 66607.20, 'zone_c' => 71932.07, 'zone_d' => 103281.00, 'zone_e' => 105570.04, 'zone_f' => 107607.00, 'zone_g' => 100549.14, 'zone_h' => 131511.17, 'zone_i' => 164388.96
            ],
            '70.00' => [
                'zone_a' => 50665.46, 'zone_b' => 66991.27, 'zone_c' => 72358.60, 'zone_d' => 103919.00, 'zone_e' => 106202.11, 'zone_f' => 108247.00, 'zone_g' => 101148.41, 'zone_h' => 132315.98, 'zone_i' => 165394.97
            ],
            '70.50' => [
                'zone_a' => 50894.99, 'zone_b' => 67372.44, 'zone_c' => 72772.58, 'zone_d' => 104542.00, 'zone_e' => 106822.61, 'zone_f' => 108875.00, 'zone_g' => 101734.16, 'zone_h' => 133091.84, 'zone_i' => 166364.79
            ],
            '71' => [
                'zone_a' => 680.00, 'zone_b' => 940.00, 'zone_c' => 1010.00, 'zone_d' => 1300.00, 'zone_e' => 1480.00, 'zone_f' => 1430.00, 'zone_g' => 1375.00, 'zone_h' => 1850.00, 'zone_i' => 2320.00
            ],
        ];

        return $this->mapRates($rates, RateCard::OTHER);
    }

    private function mapRates($rates, $type)
    {
        foreach ($rates as $weight => $rate) {
            foreach ($rate as $key => $val) {
                $rate[$key] = (double) $val;
            }
            $rate['weight'] = (double) $weight;
            $rate['packaging_type'] = $type;

            $rates[$weight] = $rate;
        }

        return array_values($rates);
    }
}








