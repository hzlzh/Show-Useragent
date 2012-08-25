<?php

$CID_image_url = $CID_options['WB_OS_icons_url'];

$CID_width_height = "14px";

function CID_windows_detect_os($ua) {
	$os_name = $os_code = $os_ver = $pda_name = $pda_code = $pda_ver = null;

	if (preg_match('/Windows 95/i', $ua) || preg_match('/Win95/', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "95";
	} elseif (preg_match('/Windows NT 5.0/i', $ua) || preg_match('/Windows 2000/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "2000";
	} elseif (preg_match('/Win 9x 4.90/i', $ua) || preg_match('/Windows ME/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "ME";
	} elseif (preg_match('/Windows.98/i', $ua) || preg_match('/Win98/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "98";
	} elseif (preg_match('/Windows NT 6.0/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows_vista";
		$os_ver = "Vista";
	} elseif (preg_match('/Windows NT 6.1/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows_win7";
		$os_ver = "7";	
	} elseif (preg_match('/Windows NT 6.2/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows_win8";
		$os_ver = "8";	
	} elseif (preg_match('/Windows NT 5.1/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "XP";
	} elseif (preg_match('/Windows NT 5.2/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		if (preg_match('/Win64/i', $ua)) {
			$os_ver = "XP 64 bit";
		} else {
			$os_ver = "Server 2003";
		}
	}
	elseif (preg_match('/Mac_PowerPC/i', $ua)) {
		$os_name = "Mac OS";
		$os_code = "macos";
	}elseif (preg_match('/Windows Phone/i', $ua)) {
		$matches = explode(';',$ua);
		$os_name = $matches[2];
		$os_code = "windows_phone7";
	} elseif (preg_match('/Windows NT 4.0/i', $ua) || preg_match('/WinNT4.0/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "NT 4.0";
	} elseif (preg_match('/Windows NT/i', $ua) || preg_match('/WinNT/i', $ua)) {
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "NT";
	} elseif (preg_match('/Windows CE/i', $ua)) {
		list($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_pda_detect_os($ua);
		$os_name = "Windows";
		$os_code = "windows";
		$os_ver = "CE";
		if (preg_match('/PPC/i', $ua)) {
			$os_name = "Microsoft PocketPC";
			$os_code = "windows";
			$os_ver = '';
		}
		if (preg_match('/smartphone/i', $ua)) {
			$os_name = "Microsoft Smartphone";
			$os_code = "windows";
			$os_ver = '';
		}
	} else{
        $os_name = 'Unknow Os';
		$os_code = 'other';
	  }
	
	return array($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver);
}

function CID_unix_detect_os($ua) {
	$os_name = $os_ver = $os_code = null;
		if (preg_match('/Linux/i', $ua)) {
		$os_name = "Linux";
		$os_code = "linux";
		if (preg_match('#Debian#i', $ua)) {
			$os_code = "debian";
			$os_name = "Debian GNU/Linux";
		} elseif (preg_match('#Mandrake#i', $ua)) {
			$os_code = "mandrake";
			$os_name = "Mandrake Linux";
		} elseif (preg_match('#Kindle Fire#i',$ua)) {//for Kindle Fire
			$matches = explode(';',$ua);
			$os_code = "kindle";
			$matches2 = explode(')',$matches[4]);
			$os_name = $matches[2].$matches2[0];
		} elseif (preg_match('#Android#i',$ua)) {//Android
			$matches = explode(';',$ua);
			$os_code = "android";
			$matches2 = explode(')',$matches[4]);
			$os_name = $matches[2].$matches2[0];
		} elseif (preg_match('#SuSE#i', $ua)) {
			$os_code = "suse";
			$os_name = "SuSE Linux";
		} elseif (preg_match('#Novell#i', $ua)) {
			$os_code = "novell";
			$os_name = "Novell Linux";
		} elseif (preg_match('#Ubuntu#i', $ua)) {
			$os_code = "ubuntu";
			$os_name = "Ubuntu Linux";
		} elseif (preg_match('#Red ?Hat#i', $ua)) {
			$os_code = "redhat";
			$os_name = "RedHat Linux";
		} elseif (preg_match('#Gentoo#i', $ua)) {
			$os_code = "gentoo";
			$os_name = "Gentoo Linux";
		} elseif (preg_match('#Fedora#i', $ua)) {
			$os_code = "fedora";
			$os_name = "Fedora Linux";
		} elseif (preg_match('#MEPIS#i', $ua)) {
			$os_name = "MEPIS Linux";
		} elseif (preg_match('#Knoppix#i', $ua)) {
			$os_name = "Knoppix Linux";
		} elseif (preg_match('#Slackware#i', $ua)) {
			$os_code = "slackware";
			$os_name = "Slackware Linux";
		} elseif (preg_match('#Xandros#i', $ua)) {
			$os_name = "Xandros Linux";
		} elseif (preg_match('#Kanotix#i', $ua)) {
			$os_name = "Kanotix Linux";
		} 
	} elseif (preg_match('/FreeBSD/i', $ua)) {
		$os_name = "FreeBSD";
		$os_code = "freebsd";
	} elseif (preg_match('/NetBSD/i', $ua)) {
		$os_name = "NetBSD";
		$os_code = "netbsd";
	} elseif (preg_match('/OpenBSD/i', $ua)) {
		$os_name = "OpenBSD";
		$os_code = "openbsd";
	} elseif (preg_match('/IRIX/i', $ua)) {
		$os_name = "SGI IRIX";
		$os_code = "sgi";
	} elseif (preg_match('/SunOS/i', $ua)) {
		$os_name = "Solaris";
		$os_code = "sun";
	} elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
		$os_name = "iPod";
		$os_code = "iphone";
		$os_ver = $matches[1];
	} elseif (preg_match('#iPhone.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
		$os_name = "iPhone";
		$os_code = "iphone";
		$os_ver = $matches[1];
	} elseif (preg_match('#iPad.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
		$os_name = "iPad";
		$os_code = "ipad";
		$os_ver = $matches[1];
	} elseif (preg_match('/Mac OS X.([0-9. _]+)/i', $ua, $matches)) {
		$os_name = "Mac OS";
		$os_code = "macos";
		if(count(explode(7,$matches[1]))>1) $matches[1] = 'Lion '.$matches[1];
		elseif(count(explode(8,$matches[1]))>1) $matches[1] = 'Mountain Lion '.$matches[1];
		$os_ver = "X ".$matches[1];
	} elseif (preg_match('/Macintosh/i', $ua)) {
		$os_name = "Mac OS";
		$os_code = "macos";
	} elseif (preg_match('/Unix/i', $ua)) {
		$os_name = "UNIX";
		$os_code = "unix";
	} elseif (preg_match('/CrOS/i', $ua)){
		$os_name="Google Chrome OS";
		$os_code="chromeos";
	} elseif (preg_match('/Fedor.([0-9. _]+)/i', $ua, $matches)){
		$os_name="Fedora";
		$os_code="fedora";
		$os_ver = $matches[1];
	} else{
        $os_name = 'Unknow Os';
		$os_code = 'other';
	}
	  
	return array($os_name, $os_code, $os_ver);
}

function CID_pda_detect_os($ua) {
	$os_name = $os_code = $os_ver = $pda_name = $pda_code = $pda_ver = null;
	if (preg_match('#PalmOS#i', $ua)) {
		$os_name = "Palm OS";
		$os_code = "palm";
	} elseif (preg_match('#Windows CE#i', $ua)) {
		$os_name = "Windows CE";
		$os_code = "windows";
	} elseif (preg_match('#QtEmbedded#i', $ua)) {
		$os_name = "Qtopia";
		$os_code = "linux";
	} elseif (preg_match('#Zaurus#i', $ua)) {
		$os_name = "Linux";
		$os_code = "linux";
	} elseif (preg_match('#Symbian#i', $ua)) {
		$os_name = "Symbian OS";
		$os_code = "symbian";
	} elseif (preg_match('#PalmOS/sony/model#i', $ua)) {
		$pda_name = "Sony Clie";
		$pda_code = "sony";
	} elseif (preg_match('#Zaurus ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$pda_name = "Sharp Zaurus " . $matches[1];
		$pda_code = "zaurus";
		$pda_ver = $matches[1];
	} elseif (preg_match('#Series ([0-9]+)#i', $ua, $matches)) {
		$pda_name = "Series";
		$pda_code = "nokia";
		$pda_ver = $matches[1];
	} elseif (preg_match('#Nokia ([0-9]+)#i', $ua, $matches)) {
		$pda_name = "Nokia";
		$pda_code = "nokia";
		$pda_ver = $matches[1];
	} elseif (preg_match('#SIE-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Siemens";
		$pda_code = "siemens";
		$pda_ver = $matches[1];
	} elseif (preg_match('#dopod([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Dopod";
		$pda_code = "dopod";
		$pda_ver = $matches[1];
	} elseif (preg_match('#o2 xda ([a-zA-Z0-9 ]+);#i', $ua, $matches)) {
		$pda_name = "O2 XDA";
		$pda_code = "o2";
		$pda_ver = $matches[1];
	} elseif (preg_match('#SEC-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Samsung";
		$pda_code = "samsung";
		$pda_ver = $matches[1];
	} elseif (preg_match('#SonyEricsson ?([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "SonyEricsson";
		$pda_code = "sonyericsson";
		$pda_ver = $matches[1];
	} elseif (preg_match('#Kindle\/([a-zA-Z0-9. ×\(.\)]+)#i',$ua, $matches)) {//for Kindle
		$pda_name = "kindle";
		$pda_code = "kindle";
		$pda_ver = $matches[1];
	} else {
		$pda_name = 'Unknow Os';
		$pda_code = 'other';
	  }
	  
	return array($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver);
}

function CID_detect_browser($ua) {
	$browser_name = $browser_code = $browser_ver = $os_name = $os_code = $os_ver = $pda_name = $pda_code = $pda_ver = null;
	$ua = preg_replace("/FunWebProducts/i", "", $ua);
	if (preg_match('#MovableType[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'MovableType';
		$browser_code = 'mt';
		$browser_ver = $matches[1];
	} elseif (preg_match('#WordPress[ /]([a-zA-Z0-9.]*)#i', $ua, $matches)) {
		$browser_name = 'WordPress';
		$browser_code = 'wp';
		$browser_ver = $matches[1];
	} elseif (preg_match('#typepad[ /]([a-zA-Z0-9.]*)#i', $ua, $matches)) {
		$browser_name = 'TypePad';
		$browser_code = 'typepad';
		$browser_ver = $matches[1];
	} elseif (preg_match('#drupal#i', $ua)) {
		$browser_name = 'Drupal';
		$browser_code = 'drupal';
		$browser_ver = count($matches) > 0 ? $matches[1] : "";
	} elseif (preg_match('#symbianos/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$os_name = "SymbianOS";
		$os_ver = $matches[1];
		$os_code = 'symbian';
	} elseif (preg_match('#avantbrowser.com#i', $ua)) {
		$browser_name = 'Avant Browser';
		$browser_code = 'avantbrowser';
	} elseif (preg_match('#(Camino|Chimera)[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Camino';
		$browser_code = 'camino';
		$browser_ver = $matches[2];
		$os_name = "Mac OS";
		$os_code = "macos";
		$os_ver = "X";
	} elseif (preg_match('#anonymouse#i', $ua, $matches)) {
		$browser_name = 'Anonymouse';
		$browser_code = 'anonymouse';
	} elseif (preg_match('#PHP#', $ua, $matches)) {
		$browser_name = 'PHP';
		$browser_code = 'php';
	} elseif (preg_match('#danger hiptop#i', $ua, $matches)) {
		$browser_name = 'Danger HipTop';
		$browser_code = 'danger';
	} elseif (preg_match('#w3m/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'W3M';
		$browser_code = 'w3m';
		$browser_ver = $matches[1];
    } elseif (preg_match('#Shiira[/]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Shiira';
		$browser_code = 'shiira';
		$browser_ver = $matches[1];
		$os_name = "Mac OS";
		$os_code = "macos";
		$os_ver = "X";
	} elseif (preg_match('#Dillo[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Dillo';
		$browser_code = 'dillo';
		$browser_ver = $matches[1];
	} elseif (preg_match('#Epiphany/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Epiphany';
		$browser_code = 'epiphany';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#UP.Browser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Openwave UP.Browser';
		$browser_code = 'openwave';
		$browser_ver = $matches[1];
	} elseif (preg_match('#DoCoMo/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'DoCoMo';
		$browser_code = 'docomo';
		$browser_ver = $matches[1];
		if ($browser_ver == '1.0') {
			preg_match('#DoCoMo/([a-zA-Z0-9.]+)/([a-zA-Z0-9.]+)#i', $ua, $matches);
			$browser_ver = $matches[2];
		} elseif ($browser_ver == '2.0') {
			preg_match('#DoCoMo/([a-zA-Z0-9.]+) ([a-zA-Z0-9.]+)#i', $ua, $matches);
			$browser_ver = $matches[2];
		}
	} elseif (preg_match('#(SeaMonkey)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Mozilla SeaMonkey';
		$browser_code = 'seamonkey';
		$browser_ver = $matches[2];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Kazehakase/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Kazehakase';
		$browser_code = 'kazehakase';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Flock/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Flock';
		$browser_code = 'flock';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/4([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Mozilla Firefox';
		$browser_code = 'firefox';
		$browser_ver = '4'.$matches[2];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Mozilla Firefox';
		$browser_code = 'firefox';
		$browser_ver = $matches[2];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Minimo/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Minimo';
		$browser_code = 'mozilla';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#MultiZilla/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'MultiZilla';
		$browser_code = 'mozilla';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'SouGou Browser';
		$browser_code = 'sogou';
		$browser_ver = '2'.$matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#baidubrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'BaiDu Browser';
		$browser_code = 'baidubrowser';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = '360 Browser';
		$browser_code = '360se';
		$browser_ver = $matches[1];
				if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#QQBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'QQ Browser';
		$browser_code = 'qqbrowser';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9.]+)/', $ua, $matches)) {
		$pda_name = "Sony PSP";
		$pda_code = "sony-psp";
		$pda_ver = $matches[1];
	} elseif (preg_match('#Galeon/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Galeon';
		$browser_code = 'galeon';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#iCab/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'iCab';
		$browser_code = 'icab';
		$browser_ver = $matches[1];
		$os_name = "Mac OS";
		$os_code = "macos";
		if (preg_match('#Mac OS X#i', $ua)) {
			$os_ver = "X";
		}
	} elseif (preg_match('#K-Meleon/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'K-Meleon';
		$browser_code = 'kmeleon';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Lynx/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Lynx';
		$browser_code = 'lynx';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#Links \\(([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Links';
		$browser_code = 'lynx';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#ELinks[/ ]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'ELinks';
		$browser_code = 'lynx';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#ELinks \\(([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'ELinks';
		$browser_code = 'lynx';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} elseif (preg_match('#Konqueror/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Konqueror';
		$browser_code = 'konqueror';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		if (!$os_name) {
			list($os_name, $os_code, $os_ver) = CID_pda_detect_os($ua);
		}
	} elseif (preg_match('#NetPositive/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'NetPositive';
		$browser_code = 'netpositive';
		$browser_ver = $matches[1];
		$os_name = "BeOS";
		$os_code = "beos";
	} elseif (preg_match('#OmniWeb#i', $ua)) {
		$browser_name = 'OmniWeb';
		$browser_code = 'omniweb';
		$os_name = "Mac OS";
		$os_code = "macos";
		$os_ver = "X";
	} elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
	$browser_name = 'Google Chrome'; $browser_code = 'chrome'; $browser_ver = $matches[1]; 
	if (preg_match('/Windows/i', $ua)) {
	list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
	} else {
	list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
	} 
	} elseif (preg_match('#Arora/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Arora';
		$browser_code = 'arora';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua,$matches)) {
		$browser_name = 'Maxthon';
		$browser_code = 'maxthon';
		$browser_ver = $matches[2];
		if (preg_match('/Win/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Chrome for iOS';
		$browser_code = 'crios';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
		 	list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}		
	} elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Safari';
		$browser_code = 'safari';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
		 	list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}		
	} elseif (preg_match('#opera mini#i', $ua)) {
		$browser_name = 'Opera Mini';
		$browser_code = 'opera';
		preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Opera';
		$browser_code = 'opera';
		$browser_ver = $matches[2];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
		if (!$os_name) {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
		if (!$os_name) {
			list($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_pda_detect_os($ua);
		}
		if (!$os_name) {
			if (preg_match('/Wii/i', $ua)) {
				$os_name = "Nintendo Wii";
				$os_code = "nintendo-wii";
			}
		}
	} elseif (preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Opera Mini';
		$browser_code = 'opera';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#WebPro/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'WebPro';
		$browser_code = 'webpro';
		$browser_ver = $matches[1];
		$os_name = "PalmOS";
		$os_code = "palmos";
	} elseif (preg_match('#WebPro#i', $ua, $matches)) {
		$browser_name = 'WebPro';
		$browser_code = 'webpro';
		$os_name = "PalmOS";
		$os_code = "palmos";
	} elseif (preg_match('#Netfront/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Netfront';
		$browser_code = 'netfront';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_pda_detect_os($ua);
	} elseif (preg_match('#Xiino/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Xiino';
		$browser_code = 'xiino';
		$browser_ver = $matches[1];
	} elseif (preg_match('/wp-blackberry\/([a-zA-Z0-9.]*)/i', $ua, $matches)) {
		$browser_name = "WordPress for BlackBerry";
		$browser_code = "wordpress";
		$browser_ver = $matches[1];
		$pda_name = "BlackBerry";
		$pda_code = "blackberry";
	} elseif (preg_match('#Blackberry([0-9]+)#i', $ua, $matches)) {
		$pda_name = "Blackberry";
		$pda_code = "blackberry";
		$pda_ver = $matches[1];
	} elseif (preg_match('#Blackberry#i', $ua)) {
		$pda_name = "Blackberry";
		$pda_code = "blackberry";
	} elseif (preg_match('#SPV ([0-9a-zA-Z.]+)#i', $ua, $matches)) {
		$pda_name = "Orange SPV";
		$pda_code = "orange";
		$pda_ver = $matches[1];
	} elseif (preg_match('#LGE-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "LG";
		$pda_code = 'lg';
		$pda_ver = $matches[1];
	} elseif (preg_match('#MOT-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Motorola";
		$pda_code = 'motorola';
		$pda_ver = $matches[1];
	} elseif (preg_match('#Nokia ?([0-9]+)#i', $ua, $matches)) {
		$pda_name = "Nokia";
		$pda_code = "nokia";
		$pda_ver = $matches[1];
	} elseif (preg_match('#NokiaN-Gage#i', $ua)) {
		$pda_name = "Nokia";
		$pda_code = "nokia";
		$pda_ver = "N-Gage";
	} elseif (preg_match('#Blazer[ /]?([a-zA-Z0-9.]*)#i', $ua, $matches)) {
		$browser_name = "Blazer";
		$browser_code = "blazer";
		$browser_ver = $matches[1];
		$os_name = "Palm OS";
		$os_code = "palm";
	} elseif (preg_match('#SIE-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Siemens";
		$pda_code = "siemens";
		$pda_ver = $matches[1];
	} elseif (preg_match('#SEC-([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "Samsung";
		$pda_code = "samsung";
		$pda_ver = $matches[1];
	} elseif (preg_match('/wp-iphone\/([a-zA-Z0-9.]*)/i', $ua, $matches)) {
		$browser_name = "WordPress for iOS";
		$browser_code = "wordpress";
		$browser_ver = $matches[1];
		$pda_name = "iPhone & iPad";
		$pda_code = "ipad";
	} elseif (preg_match('/wp-android\/([a-zA-Z0-9.]*)/i', $ua, $matches)) {
		$browser_name = "WordPress for Android";
		$browser_code = "wordpress";
		$browser_ver = $matches[1];
		$pda_name = "Android";
		$pda_code = "android";
	} elseif (preg_match('/wp-windowsphone\/([a-zA-Z0-9.]*)/i', $ua, $matches)) {
		$browser_name = "WordPress for Windows Phone 7";
		$browser_code = "wordpress";
		$browser_ver = $matches[1];
		$pda_name = "Windows Phone 7";
		$pda_code = "windows_phone7";
	} elseif (preg_match('/wp-nokia\/([a-zA-Z0-9.]*)/i', $ua, $matches)) {
		$browser_name = "WordPress for Nokia";
		$browser_code = "wordpress";
		$browser_ver = $matches[1];
		$pda_name = "Nokia";
		$pda_code = "nokia";
	} elseif (preg_match('#SAMSUNG-(S.H-[a-zA-Z0-9_/.]+)#i', $ua, $matches)) {
		$pda_name = "Samsung";
		$pda_code = "samsung";
		$pda_ver = $matches[1];
		if (preg_match('#(j2me|midp)#i', $ua)) {
		$browser_name = "J2ME/MIDP Browser";
		$browser_code = "j2me";
		}
	} elseif (preg_match('#SonyEricsson ?([a-zA-Z0-9]+)#i', $ua, $matches)) {
		$pda_name = "SonyEricsson";
		$pda_code = "sonyericsson";
		$pda_ver = $matches[1];
	} elseif (preg_match('#(j2me|midp)#i', $ua)) {
		$browser_name = "J2ME/MIDP Browser";
		$browser_code = "j2me";
	// mice
	} elseif (preg_match('/GreenBrowser/i', $ua)) {
		$browser_name = 'GreenBrowser';
		$browser_code = 'greenbrowser';
		if (preg_match('/Win/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#TencentTraveler ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = '腾讯TT浏览器';
		$browser_code = 'tencenttraveler';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'UCWEB';
		$browser_code = 'ucweb';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Internet Explorer';
		$browser_ver = $matches[1];
		if ( strpos($browser_ver, '7') !== false || strpos($browser_ver, '8') !== false)
			$browser_code = 'ie8';
		elseif ( strpos($browser_ver, '9') !== false)
			$browser_code = 'ie9';
		elseif ( strpos($browser_ver, '10') !== false)
			$browser_code = 'ie10';
		else
			$browser_code = 'ie';
		list($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_windows_detect_os($ua);
	} elseif (preg_match('#Universe/([0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Universe';
		$browser_code = 'universe';
		$browser_ver = $matches[1];
		list($os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_pda_detect_os($ua);
	}elseif (preg_match('#Netscape[0-9]?/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Netscape';
		$browser_code = 'netscape';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#^Mozilla/5.0#i', $ua) && preg_match('#rv:([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Mozilla';
		$browser_code = 'mozilla';
		$browser_ver = $matches[1];
		if (preg_match('/Windows/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	} elseif (preg_match('#^Mozilla/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
		$browser_name = 'Netscape Navigator';
		$browser_code = 'netscape';
		$browser_ver = $matches[1];
		if (preg_match('/Win/i', $ua)) {
			list($os_name, $os_code, $os_ver) = CID_windows_detect_os($ua);
		} else {
			list($os_name, $os_code, $os_ver) = CID_unix_detect_os($ua);
		}
	}else{
        $browser_name = 'Unknow Browser';
		$browser_code = 'null';
	  }
	
	  if (!$pda_name && !$os_name){
        $pda_name = 'Unknow Os';
		$pda_code = 'other';
        $os_name = 'Unknow Os';
		$os_code = 'other';
	  }
	return array($browser_name, $browser_code, $browser_ver, $os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver);
}

function CID_friendly_string($browser_name = '', $browser_code = '', $browser_ver = '', $os_name = '', $os_code = '', $os_ver = '', $pda_name= '', $pda_code = '', $pda_ver = '') {

	global $CID_options, $CID_image_url;
	
	$output = stripslashes($CID_options['WB_OS_template']);
	
	if (!$output) return "";
	
	$browser_name	= htmlspecialchars($browser_name);
	$browser_code	= htmlspecialchars($browser_code);
	$browser_ver 	= htmlspecialchars($browser_ver);
	$os_name     		= htmlspecialchars($os_name);
	$os_code     		= htmlspecialchars($os_code);
	$os_ver      		= htmlspecialchars($os_ver);
	$pda_name    		= htmlspecialchars($pda_name);
	$pda_code    		= htmlspecialchars($pda_code);
	$pda_ver     		= htmlspecialchars($pda_ver);
	
	$output = str_replace("%IMAGE_BASE%", $CID_image_url, $output);
	
	if ($browser_name && $pda_name) {
		$output = str_replace("[BROWSER]", "", $output);
		$output = str_replace("[/BROWSER]", "", $output);

		$output = str_replace("[OS]", "", $output);
		$output = str_replace("[/OS]", "", $output);
		
		$output = str_replace("%BROWSER_NAME%", $browser_name, $output);
		$output = str_replace("%BROWSER_CODE%", $browser_code, $output);
		$output = str_replace("%BROWSER_VERSION%", $browser_ver, $output);
		
		$output = str_replace("%OS_NAME%", $pda_name, $output);
		$output = str_replace("%OS_CODE%", $pda_code, $output);
		$output = str_replace("%OS_VERSION%", $pda_ver, $output);
	} elseif ($browser_name && $os_name) {
		$output = str_replace("[BROWSER]", "", $output);
		$output = str_replace("[/BROWSER]", "", $output);

		$output = str_replace("[OS]", "", $output);
		$output = str_replace("[/OS]", "", $output);
		
		$output = str_replace("%BROWSER_NAME%", $browser_name, $output);
		$output = str_replace("%BROWSER_CODE%", $browser_code, $output);
		$output = str_replace("%BROWSER_VERSION%", $browser_ver, $output);
		
		$output = str_replace("%OS_NAME%", $os_name, $output);
		$output = str_replace("%OS_CODE%", $os_code, $output);
		$output = str_replace("%OS_VERSION%", $os_ver, $output);	
	} elseif ($browser_name) {
		$output = str_replace("[BROWSER]", "", $output);
		$output = str_replace("[/BROWSER]", "", $output);
		
		$start	= strpos($output, "[OS]");
		$end  	= strpos($output, "[/OS]");
		$temp 	= substr($output, $start, $end - $start + 5);
		
		$output = str_replace($temp, "", $output);
		
		$output = str_replace("%BROWSER_NAME%", $browser_name, $output);
		$output = str_replace("%BROWSER_CODE%", $browser_code, $output);
		$output = str_replace("%BROWSER_VERSION%", $browser_ver, $output);

		$output = str_replace("%OS_NAME%", "", $output);
		$output = str_replace("%OS_CODE%", "", $output);
		$output = str_replace("%OS_VERSION%", "", $output);		
	} elseif ($os_name) {
		$output = str_replace("[OS]", "", $output);
		$output = str_replace("[/OS]", "", $output);
		
		$start	= strpos($output, "[BROWSER]");
		$end  	= strpos($output, "[/BROWSER]");
		$temp 	= substr($output, $start, $end - $start + 10);
		
		$output = str_replace($temp, "", $output);
		
		$output = str_replace("%OS_NAME%", $os_name, $output);
		$output = str_replace("%OS_CODE%", $os_code, $output);
		$output = str_replace("%OS_VERSION%", $os_ver, $output);

		$output = str_replace("%BROWSER_NAME%", "", $output);
		$output = str_replace("%BROWSER_CODE%", "", $output);
		$output = str_replace("%BROWSER_VERSION%", "", $output);		
	} elseif ($pda_name) {
		$output = str_replace("[OS]", "", $output);
		$output = str_replace("[/OS]", "", $output);
		
		$start	= strpos($output, "[BROWSER]");
		$end  	= strpos($output, "[/BROWSER]");
		$temp 	= substr($output, $start, $end - $start + 10);
		
		$output = str_replace($temp, "", $output);
		
		$output = str_replace("%OS_NAME%", $pda_name, $output);
		$output = str_replace("%OS_CODE%", $pda_code, $output);
		$output = str_replace("%OS_VERSION%", $pda_ver, $output);

		$output = str_replace("%BROWSER_NAME%", "", $output);
		$output = str_replace("%BROWSER_CODE%", "", $output);
		$output = str_replace("%BROWSER_VERSION%", "", $output);
	}
	
	return $output;
}

function CID_friendly_string_without_template($browser_name = '', $browser_code = '', $browser_ver = '', $os_name = '', $os_code = '', $os_ver = '', $pda_name= '', $pda_code = '', $pda_ver = '', $show_image = true, $show_text = true, $between = '', $before = '', $after = '') {
	global $CID_width_height, $CID_image_url;
	
	$browser_name = htmlspecialchars($browser_name);
	$browser_code = htmlspecialchars($browser_code);
	$browser_ver = htmlspecialchars($browser_ver);
	$os_name = htmlspecialchars($os_name);
	$os_code = htmlspecialchars($os_code);
	$os_ver = htmlspecialchars($os_ver);
	$pda_name = htmlspecialchars($pda_name);
	$pda_code = htmlspecialchars($pda_code);
	$pda_ver = htmlspecialchars($pda_ver);
	$between = htmlspecialchars($between);
	
	$text1 = ''; $text2 = ''; $image1 = ''; $image2 = '';
	
	if ($browser_name && $pda_name) {
		if ($show_image) {
			$image1 = "<img src='$CID_image_url/$browser_code.png' title='$browser_name $browser_ver' alt='$browser_name' width='$CID_width_height' height='$CID_width_height' class='browser-icon' />";
			$image2 = "<img src='$CID_image_url/$pda_code.png' title='$pda_name $pda_ver' alt='$pda_name' width='$CID_width_height' height='$CID_width_height' class='os-icon' />";
		}
		if ($show_text) {
			$text1 = "$browser_name $browser_ver $between ";
			$text2 = "$pda_name $pda_ver";
		}
	} elseif ($browser_name && $os_name) {
		if ($show_image) {
			$image1 = "<img src='$CID_image_url/$browser_code.png' title='$browser_name $browser_ver' alt='$browser_name' width='$CID_width_height' height='$CID_width_height' class='browser-icon' /> ";
			$image2 = "<img src='$CID_image_url/$os_code.png' title='$os_name $os_ver' alt='$os_name' width='$CID_width_height' height='$CID_width_height' class='os-icon' /> ";
		}
		if ($show_text) {
			$text1 = "$browser_name $browser_ver $between ";
			$text2 = "$os_name $os_ver";
		}
	} elseif ($browser_name) {
		if ($show_image)
			$image1 = "<img src='$CID_image_url/$browser_code.png' title='$browser_name $browser_ver' alt='$browser_name' width='$CID_width_height' height='$CID_width_height' class='browser-icon' />";
		if ($show_text)
			$text1 = "$browser_name $browser_ver";
	} elseif ($os_name) {
		if ($show_image)
			$image1 = "<img src='$CID_image_url/$os_code.png' title='$os_name $os_ver' alt='$os_name' width='$CID_width_height' height='$CID_width_height' class='os-icon' /> ";
		if ($show_text)
			$text1 = "$os_name $os_ver";
	} elseif ($pda_name) {
		if ($show_image)
			$image1 = "<img src='$CID_image_url/$pda_code.png' title='$pda_name $pda_ver' alt='$pda_name' width='$CID_width_height' height='$CID_width_height' class='os-icon' />";
		if ($show_text)
			$text1 = "$pda_name $pda_ver";
	}
	return $before . $image1 . ' ' . $text1 . ' ' . $image2 . ' ' . $text2 . $after;
}

function CID_browser_string($ua) {
	list ($browser_name, $browser_code, $browser_ver, $os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_detect_browser($ua);
	$string = CID_friendly_string($browser_name, $browser_code, $browser_ver, $os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver);
	/*if (!$string) {
		$string = "Unknown browser";
	}*/
	return $string;
}

function CID_browser_string_without_template($ua, $show_image = true, $show_text = true, $between = '', $before = '', $after = '') {
	list ($browser_name, $browser_code, $browser_ver, $os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver) = CID_detect_browser($ua);
	$string = CID_friendly_string_without_template($browser_name, $browser_code, $browser_ver, $os_name, $os_code, $os_ver, $pda_name, $pda_code, $pda_ver, $show_image, $show_text, $between, $before, $after);
	/*if (!$string) {
		$string = "Unknown browser";
	}*/
	return $string;
}

function CID_get_comment_browser() {
	global $comment;
	if (!$comment->comment_agent)
		return;
	$string = CID_browser_string($comment->comment_agent);
	return $string;
}

function CID_get_comment_browser_without_template() {
	global $comment;
	if (!$comment->comment_agent)
		return;
	$string = CID_browser_string_without_template($comment->comment_agent);
	return $string;
}

function CID_print_comment_browser() {
	echo CID_get_comment_browser();
}

?>