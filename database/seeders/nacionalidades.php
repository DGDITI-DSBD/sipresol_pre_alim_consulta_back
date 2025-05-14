<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_nacionalidades;

class nacionalidades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "cve_pais"=> 101,
                "pais"=> "NAMIBIANA",
                "clave_nacionalidad"=> "NAM"
            ],
            [
                "cve_pais"=> 103,
                "pais"=> "ANGOLESA",
                "clave_nacionalidad"=> "AGO"
            ],
            [
                "cve_pais"=> 104,
                "pais"=> "ARGELIANA",
                "clave_nacionalidad"=> "DZA"
            ],
            [
                "cve_pais"=> 105,
                "pais"=> "DE BENNIN",
                "clave_nacionalidad"=> "BEN"
            ],
            [
                "cve_pais"=> 106,
                "pais"=> "BOTSWANESA",
                "clave_nacionalidad"=> "BWA"
            ],
            [
                "cve_pais"=> 107,
                "pais"=> "BURUNDESA",
                "clave_nacionalidad"=> "BDI"
            ],
            [
                "cve_pais"=> 108,
                "pais"=> "DE CABO VERDE",
                "clave_nacionalidad"=> "CPV"
            ],
            [
                "cve_pais"=> 109,
                "pais"=> "COMORENSE",
                "clave_nacionalidad"=> "COM"
            ],
            [
                "cve_pais"=> 110,
                "pais"=> "CONGOLESA",
                "clave_nacionalidad"=> "COD"
            ],
            [
                "cve_pais"=> 111,
                "pais"=> "MARFILE¥A",
                "clave_nacionalidad"=> "COG"
            ],
            [
                "cve_pais"=> 112,
                "pais"=> "CHADIANA",
                "clave_nacionalidad"=> "TCD"
            ],
            [
                "cve_pais"=> 113,
                "pais"=> "DE DJIBOUTI",
                "clave_nacionalidad"=> "DJI"
            ],
            [
                "cve_pais"=> 114,
                "pais"=> "EGIPCIA",
                "clave_nacionalidad"=> "EGY"
            ],
            [
                "cve_pais"=> 115,
                "pais"=> "ETIOPE",
                "clave_nacionalidad"=> "ETH"
            ],
            [
                "cve_pais"=> 116,
                "pais"=> "GABONESA",
                "clave_nacionalidad"=> "GAB"
            ],
            [
                "cve_pais"=> 117,
                "pais"=> "GAMBIANA",
                "clave_nacionalidad"=> "GMB"
            ],
            [
                "cve_pais"=> 118,
                "pais"=> "GHANATA",
                "clave_nacionalidad"=> "GHA"
            ],
            [
                "cve_pais"=> 119,
                "pais"=> "GUINEA",
                "clave_nacionalidad"=> "GNB"
            ],
            [
                "cve_pais"=> 120,
                "pais"=> "GUINEA",
                "clave_nacionalidad"=> "GIN"
            ],
            [
                "cve_pais"=> 121,
                "pais"=> "GUINEA ECUATORIANA",
                "clave_nacionalidad"=> "GNQ"
            ],
            [
                "cve_pais"=> 122,
                "pais"=> "LIBIA",
                "clave_nacionalidad"=> "LBY"
            ],
            [
                "cve_pais"=> 123,
                "pais"=> "KENIANA",
                "clave_nacionalidad"=> "KEN"
            ],
            [
                "cve_pais"=> 124,
                "pais"=> "LESOTHENSE",
                "clave_nacionalidad"=> "LSO"
            ],
            [
                "cve_pais"=> 125,
                "pais"=> "LIBERIANA",
                "clave_nacionalidad"=> "LBR"
            ],
            [
                "cve_pais"=> 127,
                "pais"=> "MALAWIANA",
                "clave_nacionalidad"=> "MWI"
            ],
            [
                "cve_pais"=> 128,
                "pais"=> "MALIENSE",
                "clave_nacionalidad"=> "MLI"
            ],
            [
                "cve_pais"=> 129,
                "pais"=> "MARROQUI",
                "clave_nacionalidad"=> "MAR"
            ],
            [
                "cve_pais"=> 130,
                "pais"=> "MAURICIANA",
                "clave_nacionalidad"=> "MUS"
            ],
            [
                "cve_pais"=> 131,
                "pais"=> "MAURITANA",
                "clave_nacionalidad"=> "MRT"
            ],
            [
                "cve_pais"=> 132,
                "pais"=> "MOZAMBIQUE¥A",
                "clave_nacionalidad"=> "MOZ"
            ],
            [
                "cve_pais"=> 133,
                "pais"=> "NIGERINA",
                "clave_nacionalidad"=> "NER"
            ],
            [
                "cve_pais"=> 134,
                "pais"=> "NIGERIANA",
                "clave_nacionalidad"=> "NGA"
            ],
            [
                "cve_pais"=> 135,
                "pais"=> "CENTRO AFRICANA",
                "clave_nacionalidad"=> "CAF"
            ],
            [
                "cve_pais"=> 136,
                "pais"=> "CAMERUNESA",
                "clave_nacionalidad"=> "CMR"
            ],
            [
                "cve_pais"=> 137,
                "pais"=> "TANZANIANA",
                "clave_nacionalidad"=> "TZA"
            ],
            [
                "cve_pais"=> 139,
                "pais"=> "RWANDESA",
                "clave_nacionalidad"=> "RWA"
            ],
            [
                "cve_pais"=> 140,
                "pais"=> "DEL SAHARA",
                "clave_nacionalidad"=> "ESH"
            ],
            [
                "cve_pais"=> 141,
                "pais"=> "DE SANTO TOME",
                "clave_nacionalidad"=> "STP"
            ],
            [
                "cve_pais"=> 142,
                "pais"=> "SENEGALESA",
                "clave_nacionalidad"=> "SEN"
            ],
            [
                "cve_pais"=> 143,
                "pais"=> "DE SEYCHELLES",
                "clave_nacionalidad"=> "SYC"
            ],
            [
                "cve_pais"=> 144,
                "pais"=> "SIERRA LEONESA",
                "clave_nacionalidad"=> "SLE"
            ],
            [
                "cve_pais"=> 145,
                "pais"=> "SOMALI",
                "clave_nacionalidad"=> "SOM"
            ],
            [
                "cve_pais"=> 146,
                "pais"=> "SUDAFRICANA",
                "clave_nacionalidad"=> "ZAF"
            ],
            [
                "cve_pais"=> 147,
                "pais"=> "SUDANESA",
                "clave_nacionalidad"=> "SDN"
            ],
            [
                "cve_pais"=> 148,
                "pais"=> "SWAZI",
                "clave_nacionalidad"=> "SWZ"
            ],
            [
                "cve_pais"=> 149,
                "pais"=> "TOGOLESA",
                "clave_nacionalidad"=> "TGO"
            ],
            [
                "cve_pais"=> 150,
                "pais"=> "TUNECINA",
                "clave_nacionalidad"=> "TUN"
            ],
            [
                "cve_pais"=> 151,
                "pais"=> "UGANDESA",
                "clave_nacionalidad"=> "UGA"
            ],
            [
                "cve_pais"=> 152,
                "pais"=> "ZAIRANA",
                "clave_nacionalidad"=> "ZAR"
            ],
            [
                "cve_pais"=> 153,
                "pais"=> "ZAMBIANA",
                "clave_nacionalidad"=> "ZMB"
            ],
            [
                "cve_pais"=> 154,
                "pais"=> "DE ZIMBAWI",
                "clave_nacionalidad"=> "ZWE"
            ],
            [
                "cve_pais"=> 201,
                "pais"=> "ARGENTINA",
                "clave_nacionalidad"=> "ARG"
            ],
            [
                "cve_pais"=> 202,
                "pais"=> "BAHAME¥A",
                "clave_nacionalidad"=> "BHS"
            ],
            [
                "cve_pais"=> 203,
                "pais"=> "DE BARBADOS",
                "clave_nacionalidad"=> "BRB"
            ],
            [
                "cve_pais"=> 204,
                "pais"=> "BELICE¥A",
                "clave_nacionalidad"=> "BLZ"
            ],
            [
                "cve_pais"=> 205,
                "pais"=> "BOLIVIANA",
                "clave_nacionalidad"=> "BOL"
            ],
            [
                "cve_pais"=> 206,
                "pais"=> "BRASILE¥A",
                "clave_nacionalidad"=> "BRA"
            ],
            [
                "cve_pais"=> 207,
                "pais"=> "CANADIENSE",
                "clave_nacionalidad"=> "CAN"
            ],
            [
                "cve_pais"=> 208,
                "pais"=> "COLOMBIANA",
                "clave_nacionalidad"=> "COL"
            ],
            [
                "cve_pais"=> 209,
                "pais"=> "COSTARRICENSE",
                "clave_nacionalidad"=> "CRI"
            ],
            [
                "cve_pais"=> 210,
                "pais"=> "CUBANA",
                "clave_nacionalidad"=> "CUB"
            ],
            [
                "cve_pais"=> 211,
                "pais"=> "CHILENA",
                "clave_nacionalidad"=> "CHL"
            ],
            [
                "cve_pais"=> 212,
                "pais"=> "DOMINICA",
                "clave_nacionalidad"=> "DMA"
            ],
            [
                "cve_pais"=> 214,
                "pais"=> "SALVADORE¥A",
                "clave_nacionalidad"=> "SLV"
            ],
            [
                "cve_pais"=> 215,
                "pais"=> "ESTADOUNIDENSE",
                "clave_nacionalidad"=> "USA"
            ],
            [
                "cve_pais"=> 216,
                "pais"=> "GRANADINA",
                "clave_nacionalidad"=> "VCT"
            ],
            [
                "cve_pais"=> 217,
                "pais"=> "GUATEMALTECA",
                "clave_nacionalidad"=> "GTM"
            ],
            [
                "cve_pais"=> 218,
                "pais"=> "BRITANICA",
                "clave_nacionalidad"=> "VGB"
            ],
            [
                "cve_pais"=> 219,
                "pais"=> "GUYANESA",
                "clave_nacionalidad"=> "GUY"
            ],
            [
                "cve_pais"=> 220,
                "pais"=> "HAITIANA",
                "clave_nacionalidad"=> "HTI"
            ],
            [
                "cve_pais"=> 221,
                "pais"=> "HONDURE¥A",
                "clave_nacionalidad"=> "HND"
            ],
            [
                "cve_pais"=> 222,
                "pais"=> "JAMAIQUINA",
                "clave_nacionalidad"=> "JAM"
            ],
            [
                "cve_pais"=> 223,
                "pais"=> "MEXICANA",
                "clave_nacionalidad"=> "MEX"
            ],
            [
                "cve_pais"=> 224,
                "pais"=> "NICARAGUENSE",
                "clave_nacionalidad"=> "NIC"
            ],
            [
                "cve_pais"=> 225,
                "pais"=> "PANAME¥A",
                "clave_nacionalidad"=> "PAN"
            ],
            [
                "cve_pais"=> 226,
                "pais"=> "PARAGUAYA",
                "clave_nacionalidad"=> "PRY"
            ],
            [
                "cve_pais"=> 227,
                "pais"=> "PERUANA",
                "clave_nacionalidad"=> "PER"
            ],
            [
                "cve_pais"=> 228,
                "pais"=> "PUERTORRIQUE¥A",
                "clave_nacionalidad"=> "PRI"
            ],
            [
                "cve_pais"=> 229,
                "pais"=> "DOMINICANA",
                "clave_nacionalidad"=> "DOM"
            ],
            [
                "cve_pais"=> 230,
                "pais"=> "SANTA LUCIENSE",
                "clave_nacionalidad"=> "LCA"
            ],
            [
                "cve_pais"=> 231,
                "pais"=> "SURINAMENSE",
                "clave_nacionalidad"=> "SUR"
            ],
            [
                "cve_pais"=> 232,
                "pais"=> "TRINITARIA",
                "clave_nacionalidad"=> "TTO"
            ],
            [
                "cve_pais"=> 233,
                "pais"=> "URUGUAYA",
                "clave_nacionalidad"=> "URY"
            ],
            [
                "cve_pais"=> 234,
                "pais"=> "VENEZOLANA",
                "clave_nacionalidad"=> "VEN"
            ],
            [
                "cve_pais"=> 299,
                "pais"=> "AMERICANA",
                "clave_nacionalidad"=> "USA"
            ],
            [
                "cve_pais"=> 301,
                "pais"=> "AFGANA",
                "clave_nacionalidad"=> "AFG"
            ],
            [
                "cve_pais"=> 303,
                "pais"=> "DE BAHREIN",
                "clave_nacionalidad"=> "BHR"
            ],
            [
                "cve_pais"=> 305,
                "pais"=> "BHUTANESA",
                "clave_nacionalidad"=> "BTN"
            ],
            [
                "cve_pais"=> 306,
                "pais"=> "BIRMANA",
                "clave_nacionalidad"=> "BUR"
            ],
            [
                "cve_pais"=> 307,
                "pais"=> "NORCOREANA",
                "clave_nacionalidad"=> "PRK"
            ],
            [
                "cve_pais"=> 308,
                "pais"=> "SUDCOREANA",
                "clave_nacionalidad"=> "KOR"
            ],
            [
                "cve_pais"=> 309,
                "pais"=> "CHINA",
                "clave_nacionalidad"=> "CHN"
            ],
            [
                "cve_pais"=> 310,
                "pais"=> "CHIPRIOTA",
                "clave_nacionalidad"=> "CYP"
            ],
            [
                "cve_pais"=> 311,
                "pais"=> "ARABE",
                "clave_nacionalidad"=> "SAU"
            ],
            [
                "cve_pais"=> 312,
                "pais"=> "FILIPINA",
                "clave_nacionalidad"=> "PHL"
            ],
            [
                "cve_pais"=> 313,
                "pais"=> "HINDU",
                "clave_nacionalidad"=> "IND"
            ],
            [
                "cve_pais"=> 314,
                "pais"=> "INDONESA",
                "clave_nacionalidad"=> "IDN"
            ],
            [
                "cve_pais"=> 315,
                "pais"=> "IRAQUI",
                "clave_nacionalidad"=> "IRQ"
            ],
            [
                "cve_pais"=> 316,
                "pais"=> "IRANI",
                "clave_nacionalidad"=> "IRN"
            ],
            [
                "cve_pais"=> 317,
                "pais"=> "ISRAELI",
                "clave_nacionalidad"=> "ISR"
            ],
            [
                "cve_pais"=> 318,
                "pais"=> "JAPONESA",
                "clave_nacionalidad"=> "JPN"
            ],
            [
                "cve_pais"=> 319,
                "pais"=> "JORDANA",
                "clave_nacionalidad"=> "JOR"
            ],
            [
                "cve_pais"=> 320,
                "pais"=> "CAMBOYANA",
                "clave_nacionalidad"=> "KHM"
            ],
            [
                "cve_pais"=> 321,
                "pais"=> "KUWAITI",
                "clave_nacionalidad"=> "KWT"
            ],
            [
                "cve_pais"=> 322,
                "pais"=> "LIBANESA",
                "clave_nacionalidad"=> "LBN"
            ],
            [
                "cve_pais"=> 323,
                "pais"=> "MALASIA",
                "clave_nacionalidad"=> "MYS"
            ],
            [
                "cve_pais"=> 324,
                "pais"=> "MALDIVA",
                "clave_nacionalidad"=> "MDV"
            ],
            [
                "cve_pais"=> 325,
                "pais"=> "MONGOLESA",
                "clave_nacionalidad"=> "MNG"
            ],
            [
                "cve_pais"=> 326,
                "pais"=> "NEPALESA",
                "clave_nacionalidad"=> "NPL"
            ],
            [
                "cve_pais"=> 327,
                "pais"=> "OMANESA",
                "clave_nacionalidad"=> "OMN"
            ],
            [
                "cve_pais"=> 328,
                "pais"=> "PAKISTANI",
                "clave_nacionalidad"=> "PAK"
            ],
            [
                "cve_pais"=> 329,
                "pais"=> "DEL QATAR",
                "clave_nacionalidad"=> "QAT"
            ],
            [
                "cve_pais"=> 330,
                "pais"=> "SIRIA",
                "clave_nacionalidad"=> "SYR"
            ],
            [
                "cve_pais"=> 331,
                "pais"=> "LAOSIANA",
                "clave_nacionalidad"=> "LAO"
            ],
            [
                "cve_pais"=> 332,
                "pais"=> "SINGAPORENSE",
                "clave_nacionalidad"=> "SGP"
            ],
            [
                "cve_pais"=> 334,
                "pais"=> "TAILANDESA",
                "clave_nacionalidad"=> "THA"
            ],
            [
                "cve_pais"=> 335,
                "pais"=> "TAIWANESA",
                "clave_nacionalidad"=> "TWN"
            ],
            [
                "cve_pais"=> 336,
                "pais"=> "TURCA",
                "clave_nacionalidad"=> "TUR"
            ],
            [
                "cve_pais"=> 337,
                "pais"=> "NORVIETNAMITA",
                "clave_nacionalidad"=> "VNM"
            ],
            [
                "cve_pais"=> 339,
                "pais"=> "YEMENI",
                "clave_nacionalidad"=> "YEM"
            ],
            [
                "cve_pais"=> 401,
                "pais"=> "ALBANESA",
                "clave_nacionalidad"=> "ALB"
            ],
            [
                "cve_pais"=> 403,
                "pais"=> "ALEMANA",
                "clave_nacionalidad"=> "DEU"
            ],
            [
                "cve_pais"=> 404,
                "pais"=> "ANDORRANA",
                "clave_nacionalidad"=> "AND"
            ],
            [
                "cve_pais"=> 405,
                "pais"=> "AUSTRIACA",
                "clave_nacionalidad"=> "AUT"
            ],
            [
                "cve_pais"=> 406,
                "pais"=> "BELGA",
                "clave_nacionalidad"=> "BEL"
            ],
            [
                "cve_pais"=> 407,
                "pais"=> "BULGARA",
                "clave_nacionalidad"=> "BGR"
            ],
            [
                "cve_pais"=> 408,
                "pais"=> "CHECOSLOVACA",
                "clave_nacionalidad"=> "CSK"
            ],
            [
                "cve_pais"=> 409,
                "pais"=> "DANESA",
                "clave_nacionalidad"=> "DNK"
            ],
            [
                "cve_pais"=> 410,
                "pais"=> "VATICANA",
                "clave_nacionalidad"=> "VAT"
            ],
            [
                "cve_pais"=> 411,
                "pais"=> "ESPA¥OLA",
                "clave_nacionalidad"=> "ESP"
            ],
            [
                "cve_pais"=> 412,
                "pais"=> "FINLANDESA",
                "clave_nacionalidad"=> "FIN"
            ],
            [
                "cve_pais"=> 413,
                "pais"=> "FRANCESA",
                "clave_nacionalidad"=> "FRA"
            ],
            [
                "cve_pais"=> 414,
                "pais"=> "GRIEGA",
                "clave_nacionalidad"=> "GRC"
            ],
            [
                "cve_pais"=> 415,
                "pais"=> "HUNGARA",
                "clave_nacionalidad"=> "HUN"
            ],
            [
                "cve_pais"=> 416,
                "pais"=> "IRLANDESA",
                "clave_nacionalidad"=> "IRL"
            ],
            [
                "cve_pais"=> 417,
                "pais"=> "ISLANDESA",
                "clave_nacionalidad"=> "ISL"
            ],
            [
                "cve_pais"=> 418,
                "pais"=> "ITALIANA",
                "clave_nacionalidad"=> "ITA"
            ],
            [
                "cve_pais"=> 419,
                "pais"=> "LIECHTENSTENSE",
                "clave_nacionalidad"=> "LIE"
            ],
            [
                "cve_pais"=> 420,
                "pais"=> "LUXEMBURGUESA",
                "clave_nacionalidad"=> "LUX"
            ],
            [
                "cve_pais"=> 421,
                "pais"=> "MALTESA",
                "clave_nacionalidad"=> "MLT"
            ],
            [
                "cve_pais"=> 422,
                "pais"=> "MONEGASCA",
                "clave_nacionalidad"=> "MCO"
            ],
            [
                "cve_pais"=> 423,
                "pais"=> "NORUEGA",
                "clave_nacionalidad"=> "NOR"
            ],
            [
                "cve_pais"=> 424,
                "pais"=> "HOLANDESA",
                "clave_nacionalidad"=> "NLD"
            ],
            [
                "cve_pais"=> 426,
                "pais"=> "PORTUGUESA",
                "clave_nacionalidad"=> "PRT"
            ],
            [
                "cve_pais"=> 427,
                "pais"=> "BRITANICA",
                "clave_nacionalidad"=> "IOT"
            ],
            [
                "cve_pais"=> 428,
                "pais"=> "SOVIETICA BIELORRUSA",
                "clave_nacionalidad"=> "BLR"
            ],
            [
                "cve_pais"=> 429,
                "pais"=> "SOVIETICA UCRANIANA",
                "clave_nacionalidad"=> "UKR"
            ],
            [
                "cve_pais"=> 430,
                "pais"=> "RUMANA",
                "clave_nacionalidad"=> "ROM"
            ],
            [
                "cve_pais"=> 431,
                "pais"=> "SAN MARINENSE",
                "clave_nacionalidad"=> "SMR"
            ],
            [
                "cve_pais"=> 432,
                "pais"=> "SUECA",
                "clave_nacionalidad"=> "SWE"
            ],
            [
                "cve_pais"=> 433,
                "pais"=> "SUIZA",
                "clave_nacionalidad"=> "CHE"
            ],
            [
                "cve_pais"=> 435,
                "pais"=> "YUGOSLAVA",
                "clave_nacionalidad"=> "YUG"
            ],
            [
                "cve_pais"=> 501,
                "pais"=> "AUSTRALIANA",
                "clave_nacionalidad"=> "AUS"
            ],
            [
                "cve_pais"=> 502,
                "pais"=> "FIJIANA",
                "clave_nacionalidad"=> "FJI"
            ],
            [
                "cve_pais"=> 503,
                "pais"=> "SALOMONESA",
                "clave_nacionalidad"=> "SLB"
            ],
            [
                "cve_pais"=> 504,
                "pais"=> "NAURUANA",
                "clave_nacionalidad"=> "NRU"
            ],
            [
                "cve_pais"=> 506,
                "pais"=> "PAPUENSE",
                "clave_nacionalidad"=> "PNG"
            ],
            [
                "cve_pais"=> 507,
                "pais"=> "SAMOANA",
                "clave_nacionalidad"=> "WSM"
            ],
            [
                "cve_pais"=> 609,
                "pais"=> "BURKINA FASO",
                "clave_nacionalidad"=> "BFA"
            ],
            [
                "cve_pais"=> 621,
                "pais"=> "ESTONIA",
                "clave_nacionalidad"=> "EST"
            ],
            [
                "cve_pais"=> 624,
                "pais"=> "MICRONECIA",
                "clave_nacionalidad"=> "FSM"
            ],
            [
                "cve_pais"=> 625,
                "pais"=> "REINO UNIDO(DEPEN. TET. BRIT.)",
                "clave_nacionalidad"=> "GBD"
            ],
            [
                "cve_pais"=> 626,
                "pais"=> "REINO UNIDO(BRIT. DEL EXT.)",
                "clave_nacionalidad"=> "GBN"
            ],
            [
                "cve_pais"=> 627,
                "pais"=> "REINO UNIDO(C. BRIT. DEL EXT.)",
                "clave_nacionalidad"=> "GBO"
            ],
            [
                "cve_pais"=> 629,
                "pais"=> "REINO UNIDO",
                "clave_nacionalidad"=> "GBR"
            ],
            [
                "cve_pais"=> 642,
                "pais"=> "KIRGUISTAN",
                "clave_nacionalidad"=> "KGZ"
            ],
            [
                "cve_pais"=> 645,
                "pais"=> "LITUANIA ",
                "clave_nacionalidad"=> "LTU"
            ],
            [
                "cve_pais"=> 648,
                "pais"=> "MOLDOVIA, REPUBLICA DE",
                "clave_nacionalidad"=> "MDA"
            ],
            [
                "cve_pais"=> 650,
                "pais"=> "MACEDONIA",
                "clave_nacionalidad"=> "MKD"
            ],
            [
                "cve_pais"=> 667,
                "pais"=> "ESLOVACA",
                "clave_nacionalidad"=> "SVK"
            ],
            [
                "cve_pais"=> 668,
                "pais"=> "ESLOVENIA",
                "clave_nacionalidad"=> "SVN"
            ],
            [
                "cve_pais"=> 684,
                "pais"=> "ESLOVAQUIA",
                "clave_nacionalidad"=> "XES"
            ]
        ];

        foreach($data as $key => $value){
            si_cat_nacionalidades::create($value);
        }

        }
    }
