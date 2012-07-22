<?php
/**
 * код для работы с memcache
 * @author shr, forshr@gmail.com
 *
 */

class ChatMemcache {
	public $memcache;
	
	public function __construct() {
		$this->memcache = new Memcache;
		$this->memcache->connect( CHAT_MEMCACHE_HOST, CHAT_MEMCACHE_PORT );
	}
	
	
	public function Set( $key, $value, $expire ) {
		if ( $this->GetServerStatus() === 0 ) {
			return FALSE;
		}
		return $this->memcache->set( $key, $value, false, $expire );
	}
	
	
	public function Get( $key ) {
		return $this->memcache->get( $key );
	}
	
	
	public function Inc( $key, $value ) {
		if ( $this->GetServerStatus() === 0 ) {
			return FALSE;
		}
		$this->memcache->increment( $key, $value );
	}
	
	
	public function Dec( $key, $value ) {
		if ( $this->GetServerStatus() === 0 ) {
			return FALSE;
		}
		$this->memcache->decrement( $key, $value );
	}
	
	public function Delete( $key ) {
		if ( $this->GetServerStatus() === 0 ) {
			return FALSE;
		}
		$this->memcache->delete( $key );
	}
	
	public function Add( $key, $value, $expire ) {
		if ( $this->GetServerStatus() === 0 ) {
			return FALSE;
		}
		return $this->memcache->add( $key, $value, false, $expire );
	}
	
	public function GetServerStatus() {
		return $this->memcache->getServerStatus( CHAT_MEMCACHE_HOST, CHAT_MEMCACHE_PORT );
	}
}
?>