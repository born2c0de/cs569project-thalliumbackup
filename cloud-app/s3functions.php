<?php
	function uploadObject($s3, $bucket, $key, $data, $acl = 'private', $contentType = "text/plain")
	{
		$try = 1;
		$sleep = 1;
		$res = "";
		do
		{
			$res = $s3->create_object($bucket, $key,
						array(							
							'body' => $data,
							'acl' => $acl,
							'contentType' => $contentType
							));
			if($res->isOK())
			{
				return true;
			}
			sleep($sleep);
			$sleep *= 2;
		}while(++$try < 6);
		return $res;
	}
?>