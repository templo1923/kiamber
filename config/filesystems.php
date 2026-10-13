<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */
     
    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => config('filesystems.disks.s3.key'),
            'secret' => config('filesystems.disks.s3.secret'),
            'region' => config('filesystems.disks.s3.region'),
            'bucket' => config('filesystems.disks.s3.bucket'),
            //'url' => env('AWS_URL'),
        ],
		
		'dropbox' => [
			  'driver' => 'dropbox',
			  'token' => config('filesystems.disks.dropbox.token'),
		],
		
		'google' => [
        'driver' => 'google',
        'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
        'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
        'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
        'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        // 'teamDriveId' => env('GOOGLE_DRIVE_TEAM_DRIVE_ID'),
        ],	
		'b2' => [
            'driver' => 's3',
            'key' => config('filesystems.disks.b2.key'),
            'secret' => config('filesystems.disks.b2.secret'),
            'region' => config('filesystems.disks.b2.region'), // Or your specific B2 region
            'bucket' => config('filesystems.disks.b2.bucket'),
            'endpoint' => config('filesystems.disks.b2.endpoint'), // e.g., 'https://s3.us-east-001.backblazeb2.com'
            'url' => env('B2_URL'), // Optional: for public URLs if needed
            'visibility' => 'public', // or 'public' as per your needs
        ],
		'e2' => [
			'driver' => 's3',
			'key' => config('filesystems.disks.e2.key'),
			'secret' => config('filesystems.disks.e2.secret'),
			'region' => config('filesystems.disks.e2.region'), // Although IDrive e2 is not region-specific like AWS, a region might be required by the S3 client. You can use 'us-east-1' or a similar placeholder if not provided by IDrive e2.
			'bucket' => config('filesystems.disks.e2.bucket'),
			'endpoint' => config('filesystems.disks.e2.endpoint'), // This is crucial for IDrive e2
			'url' => env('IDRIVE_E2_URL'),  // Optional: if you need a public URL for direct access env('IDRIVE_E2_URL')
			'throw' => false,
		],	
		'storj' => [
            'driver' => 's3',
            'key' => config('filesystems.disks.storj.key'),
            'secret' => config('filesystems.disks.storj.secret'),
            'region' => 'us-east-1', // Storj does not use regions in the traditional sense, but a placeholder is often required.
            'bucket' => config('filesystems.disks.storj.bucket'),
            'endpoint' => config('filesystems.disks.storj.endpoint'), // e.g., 'https://gateway.storjshare.io'
            'url' => env('STORJ_URL'), // Optional: if you need a public URL for your files https://link.storjshare.io/s/your_storj_bucket_name
            'use_path_style_endpoint' => true, // Important for Storj compatibility 
			'visibility' => 'public',
        ],

    ],

];
