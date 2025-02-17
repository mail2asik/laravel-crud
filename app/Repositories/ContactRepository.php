<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ContactException;
use App\Repositories\Traits\ModelTrait;

class ContactRepository
{
    use ModelTrait;

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->setModel($contact);
    }

    /**
     * Get a contacts
     * @param array $limit
     * @return array (Contact)
     * @throws ContactException
     */
    public function getContacts($limit)
    {
        try {
            $contacts = $this->getModel()->select('uid', 'name', 'phone_number')->latest();

            return $contacts->paginate($limit);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Unknown Exception thrown ContactRepository@getContacts', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw new ContactException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Create a contact
     * @param $params
     * @return Contact
     * @throws ContactException
     */
    public function create($params)
    {
        try {
            $contact = new Contact();

            $contact->uid = (string) Str::uuid();
            $contact->name = $params['name'];
            $contact->phone_number = $params['phone_number'];
            
            $contact->save();

            return $contact;
        } catch (ContactException $e) {
            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'ContactException thrown ContactRepository@create', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw $e;
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Unknown Exception thrown ContactRepository@create', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw new ContactException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Get a contact by uid
     * @param $contact_uid
     * @return Contact
     * @throws ContactException
     */
    public function getContactByUid($contact_uid)
    {
        try {
            $contact = $this->getModel()->select('id', 'uid', 'name', 'phone_number')->where('uid', $contact_uid)->first();

            if (empty($contact)) {
                throw new ContactException('Contact not found');
            }

            return $contact;
        } catch (ContactException $e) {
            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'ContactException thrown ContactRepository@getContactByUid', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw $e;
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Unknown Exception thrown ContactRepository@getContactByUid', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw new ContactException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update contact by uid
     * @param $params
     * @param $contact_uid
     * @return Contact
     * @throws ContactException
     */
    public function updateContactByUid($params, $contact_uid)
    {
        try {
            $contact = $this->getContactByUid($contact_uid);
            
            $updated = Contact::find($contact->id)->update($params);

            return $updated;

        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Unknown Exception thrown ContactRepository@updateContactByUid', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw new ContactException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete contact by uid
     * @param $contact_uid
     * @return Boolean
     * @throws ContactException
     */
    public function deleteContactByUid($contact_uid)
    {
        try {
            $contact = $this->getContactByUid($contact_uid);

            $contact->delete();

            return true;

        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Unknown Exception thrown ContactRepository@deleteContactByUid', [
                'exception_type' => get_class($e),
                'message'        => $e->getMessage(),
                'code'           => $e->getCode(),
                'line_no'        => $e->getLine(),
                'params'         => func_get_args()
            ]);

            throw new ContactException($e->getMessage(), $e->getCode());
        }
    }
    
}

