<?php

use SilverStripe\Core\Extension;
use CyberDuck\GTM\GTM;

class GTMExtension extends Extension
{
	public function TagManager()
	{
    	return GTM::snippet();
	}
}