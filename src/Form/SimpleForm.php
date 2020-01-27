<?php

namespace Drupal\drupal_form\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an example form.
 */

class SimpleForm extends FormBase{


    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'simple_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['number_1'] = [
            '#type' => 'textfield',
            '#title' => $this->t('first number'),
        ];

        $form['number_2'] = [
            '#type' => 'textfield',
            '#title' => $this->t('second  number'),
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('calculate'),
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $profile_value= array(
            'number_1' => $form_state->getValue('number_1'),
            'number_2' => $form_state->getValue('number_2'),
            'somme' => $form_state->getValue('number_1')+ $form_state->getValue('number_2')/2,
        );
        $query=\Drupal::database();
        $query->insert('form_1')->fields( $profile_value)->execute();

////        if(!is_null($query)){
////            drupal_set_message("DATA SAVED");
        drupal_set_message($this->t(
            'Your number_1 is @number_1 <br>)
                    Your number_2 is @number_2 <br>
                    Your somme is @somme'),
                array(
                    '@number_1' => $form_state->getValue('number_1'),
                    '@number_2' => $form_state->getValue('number_2'),
                    '@somme' => $form_state->getValue('number_1')+ $form_state->getValue('number_2')/2,));


    }

}

