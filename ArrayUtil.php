<?php


class ArrayUtil
{

	/**
	 * take an array and split into the given number of arrays with equal number of elements
	 * if an uneven number of elements one (or more) arrays may have more elements then the others
	 *
	 * @example http://codeshare.io/kQHx5
	 * 
	 * @param array The array we want to split
	 * @param int The number of sections we want
	 * @return array The resulting split array
	 */
	public static function splitArray($array, $sections)
	{
		if(count($array) < $sections) {

			$chunkSize = 1;
		} else {

			$chunkSize = (count($array) / $sections);
		}

		return array_chunk($array, $chunkSize, true);
	}

	/**
	 * Add new elements to the given array after the element with the supplied key
	 *
	 * @example http://codeshare.io/vsu9o
	 * 
	 * @param array The array we want to add to
	 * @param string|int The key we wish to add our new elements after.
	 * @param array The elements we wish to add
	 * @return array The resulting array with new elements
	 */
	public static function addAfter($array, $key, $new_elements)
	{
		$offset = self::getOffsetByKey($array, $key);

		if ($offset >= 0) {

			// increment cause we want to actually splice in from the element AFTER the one we found
			$offset++;

			// get the slice, and insert the new elements and rebuild the array
			$array_items = array_splice($array, $offset);
			$new_elements += $array_items;
			$array += $new_elements;
		}

		return $array;
	}

	/**
	 * get the offset of an element within an array based on the key
	 * useful for associative arrays
	 *
	 * @param array The containing array
	 * @param string The key to search for
	 * @return int|null The offset within an array | null if not found
	 */
	public static function getOffsetByKey($array, $needle)
	{
		$offset = 0;

		foreach ($array as $key => $value) {

			if ($key === $needle) {

				return $offset;
			}

			$offset++;
		}

		return null;
	}

	/**
	 * get the offset of an element within an array based on the element value
	 * useful for associative arrays
	 *
	 * @param array The containing array
	 * @param string The value to search for
	 * @return int|null The offset within an array | null if not found
	 */
	public static function getOffsetByValue($array, $needle)
	{
		$offset = 0;

		foreach ($array as $key => $value) {

			if ($value === $needle) {

				return $offset;
			}

			$offset++;
		}

		return null;
	}
	
	/**
	 * Produces the cartesian product of all the given arrays
	 * 
	 * @param array Array of Arrays to combine e.g. array( array('a', 'b'), array('1', '2') )
	 * @return array Array of products e.g. array( array('a', '1'), array('a', '2'), array('b', '1'), array('b', '2')) 
	 */
	public static function array_cartesian_product($arrays)
	{
	    $result = array();
	    $arrays = array_values($arrays);
	    $sizeIn = sizeof($arrays);
	    $size = $sizeIn > 0 ? 1 : 0;
	    foreach ($arrays as $array) {
	    	
	    	$size = $size * sizeof($array);
	    	
	    }
	        
	    for ($i = 0; $i < $size; $i ++) {
	    	
	        $result[$i] = array();
	        for ($j = 0; $j < $sizeIn; $j ++) {
	        	
	            array_push($result[$i], current($arrays[$j]));	        	
	            
	        }

	        for ($j = ($sizeIn -1); $j >= 0; $j --) {
	        	
	            if (next($arrays[$j])) {
	            	
	            	break;
	            	
	            } elseif (isset ($arrays[$j])) {
	            	
	            	reset($arrays[$j]);
	            	
	            }
	                
	        }
	        
	    }
	    return $result;
	}

}
