<?php
use Migrations\AbstractSeed;

/**
 * Banks seed.
 */
class BanksSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'code' => '002',
                'name' => 'PT. BANK RAKYAT INDONESIA (PERSERO), Tbk',
            ],
            [
                'id' => '2',
                'code' => '008',
                'name' => 'PT. BANK MANDIRI (PERSERO), Tbk',
            ],
            [
                'id' => '3',
                'code' => '009',
                'name' => 'PT. BANK NEGARA INDONESIA (PERSERO),Tbk',
            ],
            [
                'id' => '4',
                'code' => '011',
                'name' => 'PT. BANK DANAMON INDONESIA, Tbk',
            ],
            [
                'id' => '5',
                'code' => '013',
                'name' => 'PT. BANK PERMATA, Tbk (d/h PT BANK BALI Tbk)',
            ],
            [
                'id' => '6',
                'code' => '014',
                'name' => 'PT. BANK CENTRAL ASIA, Tbk.',
            ],
            [
                'id' => '7',
                'code' => '016',
                'name' => 'PT. BANK INTERNASIONAL INDONESIA, Tbk',
            ],
            [
                'id' => '8',
                'code' => '019',
                'name' => 'PT. PAN INDONESIA BANK, Tbk',
            ],
            [
                'id' => '9',
                'code' => '022',
                'name' => 'PT. BANK CIMB NIAGA, Tbk d/h NIAGA',
            ],
            [
                'id' => '10',
                'code' => '023',
                'name' => 'PT. BANK UOB INDONESIA TBK',
            ],
            [
                'id' => '11',
                'code' => '028',
                'name' => 'PT. BANK OCBC NISP, Tbk d/h PT BANK NISP TBK',
            ],
            [
                'id' => '12',
                'code' => '031',
                'name' => 'CITIBANK N.A.',
            ],
            [
                'id' => '13',
                'code' => '032',
                'name' => 'JP MORGAN CHASE BANK, NA',
            ],
            [
                'id' => '14',
                'code' => '033',
                'name' => 'BANK OF AMERICA, N.A',
            ],
            [
                'id' => '15',
                'code' => '036',
                'name' => 'PT. BANK WINDU KENTJANA INTERNASIONAL TBK',
            ],
            [
                'id' => '16',
                'code' => '037',
                'name' => 'PT. BANK ARTA GRAHA INTERNASIONAL, Tbk',
            ],
            [
                'id' => '17',
                'code' => '040',
                'name' => 'THE BANGKOK BANK COMP, LTD',
            ],
            [
                'id' => '18',
                'code' => '041',
                'name' => 'THE HONGKONG & SHANGHAI B.C.',
            ],
            [
                'id' => '19',
                'code' => '042',
                'name' => 'THE BANK OF TOKYO-MITSUBISHI UFJ, LTD',
            ],
            [
                'id' => '20',
                'code' => '045',
                'name' => 'PT. BANK SUMITOMO MITSUI INDONESIA',
            ],
            [
                'id' => '21',
                'code' => '046',
                'name' => 'PT. BANK DBS INDONESIA',
            ],
            [
                'id' => '22',
                'code' => '047',
                'name' => 'PT. BANK RESONA PERDANIA',
            ],
            [
                'id' => '23',
                'code' => '048',
                'name' => 'PT. BANK MIZUHO INDONESIA',
            ],
            [
                'id' => '24',
                'code' => '050',
                'name' => 'STANDARD CHARTERED BANK',
            ],
            [
                'id' => '25',
                'code' => '052',
                'name' => 'THE ROYAL BANK OF SCOTLAND NV D/H ABN AMRO BANK',
            ],
            [
                'id' => '26',
                'code' => '054',
                'name' => 'PT. BANK CAPITAL INDONESIA(d/h CREDIT LYONNAIS)',
            ],
            [
                'id' => '27',
                'code' => '057',
                'name' => 'PT. BANK BNP PARIBAS INDONESIA',
            ],
            [
                'id' => '28',
                'code' => '059',
                'name' => 'PT. KOREA EXCHANGE BANK DANAMON',
            ],
            [
                'id' => '29',
                'code' => '061',
                'name' => 'PT. BANK ANZ INDONESIA D/H ANZ PANIN BANK',
            ],
            [
                'id' => '30',
                'code' => '067',
                'name' => 'DEUTSCHE BANK AG.',
            ],
            [
                'id' => '31',
                'code' => '068',
                'name' => 'PT. BANK WOORI INDONESIA',
            ],
            [
                'id' => '32',
                'code' => '069',
                'name' => 'BANK OF CHINA, LTD',
            ],
            [
                'id' => '33',
                'code' => '076',
                'name' => 'PT. BANK BUMI ARTA',
            ],
            [
                'id' => '34',
                'code' => '087',
                'name' => 'PT. BANK EKONOMI RAHARJA TBK',
            ],
            [
                'id' => '35',
                'code' => '088',
                'name' => 'PT. BANK ANTAR DAERAH',
            ],
            [
                'id' => '36',
                'code' => '089',
                'name' => 'PT. BANK RABOBANK INT IND d/h BANK HAGA',
            ],
            [
                'id' => '37',
                'code' => '095',
                'name' => 'PT. BANK MUTIARA, Tbk D/H PT BANK CENTURY TBK',
            ],
            [
                'id' => '38',
                'code' => '097',
                'name' => 'PT. BANK MAYAPADA INTERNASIONAL TBK',
            ],
            [
                'id' => '39',
                'code' => '110',
                'name' => 'PT. BPD JAWA BARAT DAN BANTEN',
            ],
            [
                'id' => '40',
                'code' => '111',
                'name' => 'PT. BANK DKI',
            ],
            [
                'id' => '41',
                'code' => '112',
                'name' => 'BPD YOGYAKARTA',
            ],
            [
                'id' => '42',
                'code' => '113',
                'name' => 'PT. BPD JAWA TENGAH',
            ],
            [
                'id' => '43',
                'code' => '114',
                'name' => 'PT. BPD JAWA TIMUR',
            ],
            [
                'id' => '44',
                'code' => '115',
                'name' => 'BPD JAMBI',
            ],
            [
                'id' => '45',
                'code' => '116',
                'name' => 'PT. BANK ACEH D/H BPD ACEH',
            ],
            [
                'id' => '46',
                'code' => '117',
                'name' => 'PT. BPD SUMATERA UTARA',
            ],
            [
                'id' => '47',
                'code' => '118',
                'name' => 'BPD SUMATERA BARAT',
            ],
            [
                'id' => '48',
                'code' => '119',
                'name' => 'PT. BPD RIAU',
            ],
            [
                'id' => '49',
                'code' => '120',
                'name' => 'PT. BPD SUMATERA SELATAN DAN BANGKA BELITUNG',
            ],
            [
                'id' => '50',
                'code' => '121',
                'name' => 'PT. BANK LAMPUNG',
            ],
            [
                'id' => '51',
                'code' => '122',
                'name' => 'PT. BPD KALIMANTAN SELATAN',
            ],
            [
                'id' => '52',
                'code' => '123',
                'name' => 'PT. BPD KALIMANTAN BARAT',
            ],
            [
                'id' => '53',
                'code' => '124',
                'name' => 'BPD KALIMANTAN TIMUR',
            ],
            [
                'id' => '54',
                'code' => '125',
                'name' => 'PT. BPD BANK KALIMANTAN TENGAH',
            ],
            [
                'id' => '55',
                'code' => '126',
                'name' => 'PT. BPD SULAWESI SELATAN DAN SULAWESI BARAT',
            ],
            [
                'id' => '56',
                'code' => '127',
                'name' => 'PT. BPD SULAWESI UTARA',
            ],
            [
                'id' => '57',
                'code' => '128',
                'name' => 'PT. BPD NUSA TENGGARA BARAT',
            ],
            [
                'id' => '58',
                'code' => '129',
                'name' => 'PT. BPD BALI',
            ],
            [
                'id' => '59',
                'code' => '130',
                'name' => 'PT. BPD NUSA TENGGARA TIMUR',
            ],
            [
                'id' => '60',
                'code' => '131',
                'name' => 'PT. BPD MALUKU',
            ],
            [
                'id' => '61',
                'code' => '132',
                'name' => 'PT. BPD PAPUA',
            ],
            [
                'id' => '62',
                'code' => '133',
                'name' => 'PT. BPD BENGKULU',
            ],
            [
                'id' => '63',
                'code' => '134',
                'name' => 'PT. BPD SULAWESI TENGAH',
            ],
            [
                'id' => '64',
                'code' => '135',
                'name' => 'PT. BPD SULAWESI TENGGARA',
            ],
            [
                'id' => '65',
                'code' => '145',
                'name' => 'PT. BANK NUSANTARA PARAHYANGAN TBK.',
            ],
            [
                'id' => '66',
                'code' => '146',
                'name' => 'PT. BANK SWADESI, Tbk',
            ],
            [
                'id' => '67',
                'code' => '147',
                'name' => 'PT. BANK MUAMALAT INDONESIA',
            ],
            [
                'id' => '68',
                'code' => '151',
                'name' => 'PT. BANK MESTIKA DHARMA',
            ],
            [
                'id' => '69',
                'code' => '152',
                'name' => 'PT. BANK METRO EKSPRESS',
            ],
            [
                'id' => '70',
                'code' => '153',
                'name' => 'PT. BANK SINAR MAS',
            ],
            [
                'id' => '71',
                'code' => '157',
                'name' => 'PT. BANK MASPION INDONESIA',
            ],
            [
                'id' => '72',
                'code' => '161',
                'name' => 'PT. BANK GANESHA',
            ],
            [
                'id' => '73',
                'code' => '164',
                'name' => 'PT. BANK ICBC INDONESIA',
            ],
            [
                'id' => '74',
                'code' => '167',
                'name' => 'PT. BANK QNB KESAWAN, Tbk',
            ],
            [
                'id' => '75',
                'code' => '200',
                'name' => 'PT. BANK TABUNGAN NEGARA (PERSERO)',
            ],
            [
                'id' => '76',
                'code' => '212',
                'name' => 'PT. BANK HIMPUNAN SAUDARA 1906',
            ],
            [
                'id' => '77',
                'code' => '213',
                'name' => 'PT. BANK TABUNGAN PENSIUNAN NASIONAL TBK',
            ],
            [
                'id' => '78',
                'code' => '405',
                'name' => 'PT. BANK VICTORIA SYARIAH d/h BANK SWAGUNA',
            ],
            [
                'id' => '79',
                'code' => '422',
                'name' => 'PT. BANK BRI SYARIAH d/h DJASA ARTHA',
            ],
            [
                'id' => '80',
                'code' => '425',
                'name' => 'PT BANK JABAR BANTEN SYARIAH',
            ],
            [
                'id' => '81',
                'code' => '426',
                'name' => 'PT BANK MEGA, Tbk',
            ],
            [
                'id' => '82',
                'code' => '427',
                'name' => 'PT BANK BNI SYARIAH',
            ],
            [
                'id' => '83',
                'code' => '441',
                'name' => 'PT. BANK BUKOPIN',
            ],
            [
                'id' => '84',
                'code' => '451',
                'name' => 'PT. BANK SYARIAH MANDIRI, Tbk',
            ],
            [
                'id' => '85',
                'code' => '459',
                'name' => 'PT. BANK BISNIS INTERNASIONAL',
            ],
            [
                'id' => '86',
                'code' => '466',
                'name' => 'PT. BANK ANDARA d/h SRI PARTHA',
            ],
            [
                'id' => '87',
                'code' => '472',
                'name' => 'PT. BANK JASA JAKARTA',
            ],
            [
                'id' => '88',
                'code' => '484',
                'name' => 'PT. BANK HANA D/H BINTANG MANUNGGAL',
            ],
            [
                'id' => '89',
                'code' => '485',
                'name' => 'PT. BANK ICB BUMIPUTERA,Tbkd/hBumiputera Indonesia',
            ],
            [
                'id' => '90',
                'code' => '490',
                'name' => 'PT. BANK YUDHA BHAKTI',
            ],
            [
                'id' => '91',
                'code' => '491',
                'name' => 'PT. BANK MITRANIAGA',
            ],
            [
                'id' => '92',
                'code' => '494',
                'name' => 'PT. BANK RAKYAT INDONESIA AGRONIAGA, TBK',
            ],
            [
                'id' => '93',
                'code' => '498',
                'name' => 'PT. BANK SBI INDONESIA d/h INDOMONEX',
            ],
            [
                'id' => '94',
                'code' => '501',
                'name' => 'PT. BANK ROYAL INDONESIA',
            ],
            [
                'id' => '95',
                'code' => '503',
                'name' => 'PT. BANK NATIONALNOBU D/H PT BANK ALFINDO',
            ],
            [
                'id' => '96',
                'code' => '506',
                'name' => 'PT. BANK MEGA SYARIAH(dh B MG SY IND/TUGU)',
            ],
            [
                'id' => '97',
                'code' => '513',
                'name' => 'PT. BANK INA PERDANA',
            ],
            [
                'id' => '98',
                'code' => '517',
                'name' => 'PT. BANK PANIN SYARIAH D/H HARFA',
            ],
            [
                'id' => '99',
                'code' => '520',
                'name' => 'PT. BANK PRIMA MASTER',
            ],
            [
                'id' => '100',
                'code' => '521',
                'name' => 'PT. BANK SYARIAH BUKOPIN D/H PERSYARIKATAN IND.',
            ],
            [
                'id' => '101',
                'code' => '523',
                'name' => 'PT. BANK SAHABAT SAMPOERNA',
            ],
            [
                'id' => '102',
                'code' => '526',
                'name' => 'PT. BANK DINAR INDONESIA',
            ],
            [
                'id' => '103',
                'code' => '531',
                'name' => 'PT. BANK ANGLOMAS INTERNASIONAL',
            ],
            [
                'id' => '104',
                'code' => '535',
                'name' => 'PT. BANK KESEJAHTERAAN EKONOMI',
            ],
            [
                'id' => '105',
                'code' => '536',
                'name' => 'PT. BANK BCA SYARIAH d/h UIB',
            ],
            [
                'id' => '106',
                'code' => '542',
                'name' => 'PT. BANK ARTOS INDONESIA',
            ],
            [
                'id' => '107',
                'code' => '547',
                'name' => 'PT. BANK SAHABAT PURBA DANARTA',
            ],
            [
                'id' => '108',
                'code' => '548',
                'name' => 'PT. BANK MULTI ARTA SENTOSA',
            ],
            [
                'id' => '109',
                'code' => '553',
                'name' => 'PT. BANK MAYORA',
            ],
            [
                'id' => '110',
                'code' => '555',
                'name' => 'PT. BANK INDEX SELINDO',
            ],
            [
                'id' => '111',
                'code' => '558',
                'name' => 'PT BANK PUNDI INDONESIA,Tbk d/h EKSEKUTIF INTL',
            ],
            [
                'id' => '112',
                'code' => '559',
                'name' => 'PT. CENTRATAMA NASIONAL BANK',
            ],
            [
                'id' => '113',
                'code' => '562',
                'name' => 'PT. BANK FAMA INTERNASIONAL',
            ],
            [
                'id' => '114',
                'code' => '564',
                'name' => 'PT. BANK SINAR HARAPAN BALI',
            ],
            [
                'id' => '115',
                'code' => '566',
                'name' => 'PT. BANK VICTORIA INTERNATIONAL',
            ],
            [
                'id' => '116',
                'code' => '567',
                'name' => 'PT. BANK HARDA INTERNASIONAL',
            ],
            [
                'id' => '117',
                'code' => '945',
                'name' => 'PT. BANK AGRIS D/H FINCONESIA',
            ],
            [
                'id' => '118',
                'code' => '947',
                'name' => 'PT. BANK MAYBANK INDOCORP',
            ],
            [
                'id' => '119',
                'code' => '949',
                'name' => 'PT. BANK CHINATRUST INDONESIA',
            ],
            [
                'id' => '120',
                'code' => '950',
                'name' => 'PT. BANK COMMONWEALTH',
            ],
            [
                'id' => '121',
                'code' => '009',
                'name' => 'PT. BANK NEGARA INDONESIA (PERSERO) / BNI',
            ],
        ];

        $table = $this->table('banks');
        $table->insert($data)->save();
    }
}
