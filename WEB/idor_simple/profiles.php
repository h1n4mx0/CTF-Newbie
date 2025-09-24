<?php
function get_profile($id) {
    $profiles = [
        '1' => [
            'name' => 'TranTien',
            'email' => 'TranTien@gmail.com',
            'about' => '1 Web Pentest Lỏ'
        ],
        '2' => [
            'name' => 'Bob Smith',
            'email' => 'bob.smith@techcorp.com',
            'about' => 'Full-stack developer and security researcher. Enjoys participating in CTF competitions and bug bounty programs.'
        ],
        '3' => [
            'name' => 'Carol Wilson',
            'email' => 'carol.wilson@startup.io',
            'about' => 'DevOps engineer specializing in cloud infrastructure. Always looking for ways to improve system security.'
        ],
        '42' => [
            'name' => 'Deep Thought',
            'email' => 'answer@universe.com',
            'about' => 'The ultimate computer designed to find the Answer to the Ultimate Question of Life, the Universe, and Everything.'
        ],
        '100' => [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'about' => 'This is a test account used for development and testing purposes only.'
        ],
        '404' => [
            'name' => 'Not Found',
            'email' => 'notfound@void.null',
            'about' => 'This user seems to have vanished into the digital void. Error 404: User not found!'
        ],
        '1337' => [
            'name' => 'L33t H4ck3r',
            'email' => 'elite@hacker.net',
            'about' => '3l1t3 h4ck3r w1th m4d sk1llz. Sp3c14l1z3s 1n p3n3tr4t10n t3st1ng 4nd CTF ch4ll3ng3s.'
        ],
        '9999' => [
            'name' => 'Max Value',
            'email' => 'max@limits.com',
            'about' => 'MSEC{ID0R_fake_22x05}
'
        ]
    ];
    
    return isset($profiles[$id]) ? $profiles[$id] : null;
}
?>