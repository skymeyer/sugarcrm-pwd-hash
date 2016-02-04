# SugarCRM Password Hash Utility

This library generates SugarCRM compatible password hashes for SugarCRM 7.7 and up. It can be used in automation and comes with a convenient console application as well.

Examples:

    bin/hash generate "passwordgoeshere" 
    bin/hash generate "passwordgoeshere" --type=bcrypt (default)
    bin/hash generate "passwordgoeshere" --type=sha256
    bin/hash generate "passwordgoeshere" --type=sha512



