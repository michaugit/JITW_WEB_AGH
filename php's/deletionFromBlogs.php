<?php
exec ("find blogs -type d -exec chmod 0777 {} +");
echo "Zmieniono prawa dostępu wszystkim plikom w folderze Blogs :)"
?>