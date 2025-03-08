import { ethers } from "ethers";
import LoteriaPrognosticosABI from "./contracts/LoteriaPrognosticos.json";

const contractAddress = "0x..."; // Endereço do contrato deployado
const provider = new ethers.providers.Web3Provider(window.ethereum);
const signer = provider.getSigner();
const contract = new ethers.Contract(contractAddress, LoteriaPrognosticosABI, signer);
