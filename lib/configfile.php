<?php
	class ConfigFile
	{
		var $file;
		var $model;
		var $params;
		
		function __construct($file, $model = NULL)
		{
			$this->file = $file;
			$this->model  = $model or $file .".dist";
		}

		function param($param, $value)
		{
			$param = quotemeta($param);
			$this->params[$param] = $value;
		}

		function apply($content)
		{
			foreach ($this->params as $p => $v) {
				$oldcontent = $content;
				$content = ereg_replace("([^\r\n]*)$p([^\r\n]*)", $v, $content);
				if ($content == $oldcontent) {
					$content .= "\n$v";
				}
			}
			return $content;
		}

		function update()
		{
			$content = file_get_contents($this->model);
			$content = $this->apply($content);
			file_put_contents($this->file, $content);
		}
	}
