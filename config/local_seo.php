<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Local SEO Configuration for Purnia, Bihar
    |--------------------------------------------------------------------------
    |
    | Location-specific SEO configuration for Zuppie Events
    |
    */

    'primary_location' => [
        'name' => 'Purnia',
        'state' => 'Bihar',
        'country' => 'India',
        'postal_code' => '854301',
        'coordinates' => [
            'latitude' => 25.7788,
            'longitude' => 87.4742,
        ],
        'timezone' => 'Asia/Kolkata',
        'area_code' => '06454',
        'district' => 'Purnia',
        'division' => 'Purnia',
        'region' => 'Eastern India',
    ],

    'service_areas' => [
        'primary' => [
            'Purnia', 'Katihar', 'Araria', 'Kishanganj', 'Darbhanga', 'Madhubani'
        ],
        'secondary' => [
            'Siliguri', 'Malda', 'Murshidabad', 'Cooch Behar', 'Jalpaiguri', 'Alipurduar'
        ],
        'extended' => [
            'Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Bihar Sharif', 'Begusarai'
        ]
    ],

    'local_keywords' => [
        'primary' => [
            'event planning Purnia', 'birthday party Purnia', 'anniversary celebration Purnia',
            'decoration services Purnia', 'event management Purnia', 'party planner Purnia',
            'festival celebration Purnia', 'wedding planning Purnia', 'corporate events Purnia'
        ],
        'secondary' => [
            'Purnia event organizer', 'Purnia party decorations', 'Purnia celebration services',
            'Purnia birthday decorations', 'Purnia anniversary planning', 'Purnia festival events',
            'Purnia wedding planner', 'Purnia event coordinator', 'Purnia party planning'
        ],
        'regional' => [
            'Bihar event management', 'Bihar party planning', 'Bihar celebration services',
            'Bihar wedding planning', 'Bihar birthday parties', 'Bihar anniversary events',
            'Bihar festival celebrations', 'Bihar corporate events', 'Bihar event decorations'
        ]
    ],

    'competitors' => [
        'direct' => [
            'Purnia Event Planners', 'Bihar Celebrations', 'Eastern India Events'
        ],
        'indirect' => [
            'Local decorators', 'Catering services', 'Photography services', 'Venue providers'
        ]
    ],

    'local_business_schema' => [
        'price_range' => '$$',
        'payment_accepted' => ['Cash', 'Credit Card', 'Debit Card', 'UPI', 'Net Banking'],
        'currencies_accepted' => 'INR',
        'opening_hours' => 'Mo-Fr 09:00-18:00, Sa 09:00-16:00, Su 10:00-16:00',
        'areas_served' => 'Purnia, Katihar, Araria, Kishanganj, Bihar, India',
        'service_types' => [
            'Event Planning', 'Birthday Parties', 'Anniversary Celebrations',
            'Wedding Planning', 'Corporate Events', 'Festival Celebrations',
            'Decoration Services', 'Party Planning', 'Event Management'
        ]
    ],

    'local_citations' => [
        'google_my_business' => [
            'category' => 'Event Planner',
            'description' => 'Professional event planning and celebration services in Purnia, Bihar. Specializing in birthdays, anniversaries, weddings, and corporate events.'
        ],
        'directories' => [
            'justdial.com',
            'sulekha.com',
            'urbanpro.com',
            'indiamart.com',
            'tradeindia.com'
        ]
    ],

    'local_content_topics' => [
        'Purnia event venues', 'Bihar wedding traditions', 'Local festival celebrations',
        'Purnia party suppliers', 'Bihar cultural events', 'Local catering services',
        'Purnia photography services', 'Bihar event decorations', 'Local event planning tips'
    ],

    'seasonal_events' => [
        'durga_puja' => 'September-October',
        'diwali' => 'October-November',
        'holi' => 'March',
        'karva_chauth' => 'October-November',
        'bhai_dooj' => 'October-November',
        'wedding_season' => 'November-February',
        'birthday_season' => 'Year Round'
    ]
];
