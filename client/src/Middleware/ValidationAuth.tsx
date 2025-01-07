import { useNavigate } from 'react-router-dom';
import Cookies from 'js-cookie';
import { useEffect, useState } from 'react';
import LoadingPage  from '../Components/LoadingPage';

function ValidationAuth(Component) {
  return function GetPage() {
    const navigate = useNavigate();
    const [isValidating, setIsValidating] = useState(true);
    const authToken = Cookies.get('auth-token');

    useEffect(() => {
      const verifyToken = async () => {
        try {
          if (!authToken) {
            navigate('/signin');
            return;
          }

          const apiUrl = import.meta.env.VITE_APP_API_URL;
          const res = await fetch(`${apiUrl}/validetk`, {
            method: 'POST',
            headers: {
              Authorization: `Bearer ${authToken}`,
              'Content-Type': 'application/json',
            },
          });

          if (!res.ok) {
            navigate('/signin');
            return;
          }

          const data = await res.json();
          if (!data.isValid) {
            navigate('/signin');
            return;
          }

          setIsValidating(false);
        } catch (error) {
          console.error('Token validation error:', error);
          navigate('/signin');
        }
      };
      verifyToken();
  
    }, [authToken, navigate]);

    if (isValidating) {
      return <LoadingPage />;
    }

    return <Component />;
  };
}

export default ValidationAuth;