<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsProfileController extends AbstractController
{
    #[Route('/settings/profile', name: 'app_settings_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profile(
	    Request $request,
	    UserRepository $users,
	    EntityManagerInterface $entityManager
    ): Response
    {
	    /** @var User $user */
	    $user =  $this->getUser();
		$userProfile = $user->getUserProfile() ?? new UserProfile();
		
		$form = $this->createForm(
			UserProfileType::class, $userProfile
		);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$userProfile = $form->getData();
			$user->setUserProfile($userProfile);
			$entityManager->persist($user);
			$entityManager->flush();
			$this->addFlash(
				'success',
				'Your user profile settings were saved.'
			);
			
			return $this->redirectToRoute(
				'app_settings_profile'	
			);
		}

		// Save this
		// Add the flash message
		// Redirect
		
        return $this->render(
        	'settings_profile/profile.html.twig', 
        	[
	        	'form' => $form->createView()
			]
		);
    }
}
