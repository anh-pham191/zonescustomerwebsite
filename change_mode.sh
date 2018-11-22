#!/bin/bash

chmod -v 666 system/expressionengine/config/config.php
chmod -v 666 system/expressionengine/config/database.php

chmod -v 777 system/expressionengine/cache/
chmod -v 777 system/expressionengine/templates/
chmod -v 777 images/avatars/uploads/
chmod -v 777 images/captchas/
chmod -v 777 images/member_photos/
chmod -v 777 images/pm_attachments/
chmod -v 777 images/signature_attachments/
chmod -v 777 images/uploads/
